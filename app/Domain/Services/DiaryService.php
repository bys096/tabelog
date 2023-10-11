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
use Illuminate\Support\Facades\DB;


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
        return DB::transaction(function () use ($userId, $dto) {
            try {
                $today = Carbon::now()->toDateString();

                $diary = $this->diaryRepository->findByDateAndUserId($today, $userId);

                if (!$diary) {
                    $user = $this->userRepository->findById($userId);
                    if (!$user) {
                        Log::error("User ID not found.");
                    }

                    $diary = $user->diaries()->create(['date' => $dto->getDate()]);
                    Log::info('Created Diary: ' . json_encode($diary));
                }

                // Add a new segment to the diary
                $diary->diarySegments()->create([
                    'content' => $dto->getContent(),
                    'meal_time' => 'afternoon'
                ]);

            } catch (\Exception $e) {
                Log::error("Error storing diary entry: " . $e->getMessage());
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
