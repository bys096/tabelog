<?php

namespace App\Domain\Repository;

use App\Domain\Models\DiarySegment;
use App\Domain\DTO\DiaryStoreRequestDTO;

class DiarySegmentRepository implements DiarySegmentRepositoryInterface
{
    private $eloquentDiarySegment;

    public function __construct(DiarySegment $eloquentDiarySegment)
    {
        $this->eloquentDiarySegment = $eloquentDiarySegment;
    }

    public function storeDiarySegment(DiaryStoreRequestDTO $dto)
    {
        $this->eloquentDiarySegment->create([
            'diary_id' => $dto->getDiaryId(),
            'content' => $dto->getContent()
        ]);
    }
}
