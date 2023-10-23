<?php

namespace App\Domain\Services;

use App\Domain\DTO\DiaryStoreRequestDTO;
use App\Domain\DTO\DiaryUpdateRequestDTO;
use App\Domain\Models\Diary;
use App\Domain\Models\DiarySegment;
use App\Domain\Repository\DiaryRepositoryInterface;
use App\Domain\Repository\DiarySegmentRepository;
use App\Domain\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class DiaryService
{
    private $diaryRepository;
    private $diarySegmentRepository;
    private $userRepository;

    private $hashTagService;

    public function __construct(DiaryRepositoryInterface $diaryRepository, UserRepositoryInterface $userRepository,
                DiarySegmentRepository $diarySegmentRepository, HashTagService $hashTagService)
    {
        $this->diaryRepository = $diaryRepository;
        $this->userRepository = $userRepository;
        $this->diarySegmentRepository = $diarySegmentRepository;
        $this->hashTagService = $hashTagService;
    }

    public function findDiaries(int $userId)
    {
        return Diary::where('user_id', $userId)->orderBy('date', 'desc')->paginate(6);
    }

    public function findDiarySegmentsById(int $diaryId)
    {
        return DiarySegment::with('hashTags')
                    ->join('diaries', 'diaries.id', '=', 'diary_segments.diary_id')
                    ->where('diary_id',$diaryId)
                    ->select('diary_segments.id', 'diary_segments.diary_id', 'diary_segments.content', 'meal_time', 'diary_segments.created_at', 'date', 'diaries.user_id')
                    ->orderBy('diary_segments.updated_at', 'desc')
                    ->paginate(6);

    }

    public function storeDiary(int $userId, DiaryStoreRequestDTO $dto)
    {
//        Diary作成に伴うDiary SegmentとHashTagもTransactionに括り処理
        return DB::transaction(function () use ($userId, $dto) {
            try {
                $diary = $this->diaryRepository->findByDateAndUserId($dto->getDate(), $userId);

                if (!$diary) {      // 送られてきた日付で作成されたDiaryがなければ、新しいDiaryを作成してからSegmentを作成
                    $user = $this->userRepository->findById($userId);
                    if (!$user) {
                        Log::error("User ID not found.");
                    }

                    $diary = $user->diaries()->create(['date' => $dto->getDate()]);
                    Log::info('Created Diary: ' . json_encode($diary));
                }

                $newSegment = $diary->diarySegments()->create([
                    'content' => $dto->getContent(),
                    'meal_time' => $dto->getMealTime()
                ]);
                Log::info('New diary segment has been created.' . $newSegment);

                $this->hashTagService->registerHashTags($dto, $newSegment->id);
                return true;

            } catch (\Exception $e) {
                Log::error("Error storing diary entry: " . $e->getMessage());
                throw $e;
            }
        }, 5);

    }

    public function deleteDiary(int $diaryId)
    {
        $this->diaryRepository->deleteById($diaryId);
    }

    public function updateDiary(int $diaryId, DiaryUpdateRequestDTO $dto)
    {
        $diary = $this->diaryRepository->findById($diaryId);
        $diary->title = $dto->getTitle();
        $diary->content = $dto->getContent();

        $this->diaryRepository->saveDiary($diary);
    }
}
