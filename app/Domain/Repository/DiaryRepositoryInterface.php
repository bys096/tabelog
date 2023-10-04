<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\DTO\DiaryStoreRequestDTO;
use App\Domain\Entity\Diary;
use App\Domain\Models\Diary as EloquentDiary;
use App\Domain\Models\User;

interface DiaryRepositoryInterface
{

    public function findByUserId(int $userId): ?Diary;          // 유저가 작성한 다이어리 불러오기

    public function storeDiary(User $user, DiaryStoreRequestDTO $diary): int;    // 다이어리 저장

    public function deleteById(int $diaryId);

    public function saveDiary(EloquentDiary $eloquentDiary);

    public function findById(int $diaryId);
}
