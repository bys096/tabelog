<?php

namespace App\Domain\Repository;

use App\Domain\DTO\DiaryStoreRequestDTO;

interface DiarySegmentRepositoryInterface
{
    public function storeDiarySegment(DiaryStoreRequestDTO $dto);

}
