<?php

namespace App\Domain\Services;

use App\Domain\DTO\DiaryStoreRequestDTO;
use App\Domain\DTO\DiaryUpdateRequestDTO;
use App\Domain\Models\DiarySegment;
use App\Domain\Repository\DiaryRepositoryInterface;
use App\Domain\Repository\DiarySegmentRepository;
use App\Domain\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class DiaryService
{
    private $diaryRepository;
    private $diarySegmentRepository;
    private $userRepository;

    public function __construct(DiaryRepositoryInterface $diaryRepository, UserRepositoryInterface $userRepository,
                DiarySegmentRepository $diarySegmentRepository)
    {
        $this->diaryRepository = $diaryRepository;
        $this->userRepository = $userRepository;
        $this->diarySegmentRepository = $diarySegmentRepository;
    }

    public function findDiaries(int $userId)
    {
        return $this->diaryRepository->findByUserId($userId);
    }

    public function storeDiary(int $userId, DiaryStoreRequestDTO $dto)
    {

//        Log::info('UserID' . $userId);
        Log::info('date: ' . Carbon::now()->toDateString());
        $diary = $this->diaryRepository->findByCreatedAt(Carbon::now()->toDateString());
        Log::info('find result; ' . json_encode($diary));
        if ($diary == null) {
            try {
                Log::info('다이어리 미발견');
                $user = $this->userRepository->findById($userId);
                Log::info(json_encode($user));
                $newDiary = $user->diaries()->create(['date' => Carbon::now()->toDateString()]);
                $newSegment = $newDiary->diarySegments()->create([
                    'content' => $dto->getContent(),
                    'meal_time' => 'afternoon'
                ]);
            } catch (QueryException $e) {
                throw $e;
            }
        } else if($diary->date == Carbon::now()->toDateString()) {
            try {
                Log::info('diary 발견, diary Id: ' . $diary->user_id);
//                Log::info('직렬화: ' . json_encode($diary));

                $newSegment = $diary->diarySegments()->create(['content' => $dto->getContent(), 'meal_time' => 'afternoon']);
            } catch (QueryException $e) {
                throw $e;
            }
        }

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
