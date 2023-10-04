<?php

namespace App\Domain\Services;

use App\Domain\DTO\DiaryStoreRequestDTO;
use App\Domain\DTO\DiaryUpdateRequestDTO;
use App\Domain\Repository\DiaryRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
class DiaryService
{
    private $diaryRepository;
    private $userRepository;

    public function __construct(DiaryRepositoryInterface $diaryRepository, UserRepositoryInterface $userRepository)
    {
        $this->diaryRepository = $diaryRepository;
        $this->userRepository = $userRepository;
    }

    public function findDiaries(int $userId)
    {
        return $this->diaryRepository->findByUserId($userId);
    }

    public function storeDiary(int $userId, DiaryStoreRequestDTO $dto)
    {
        $user = $this->userRepository->findById($userId);
        $this->diaryRepository->storeDiary($user, $dto);
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
