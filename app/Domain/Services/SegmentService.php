<?php

namespace App\Domain\Services;

use App\Domain\Models\DiarySegment;
use App\Domain\Repository\DiaryRepositoryInterface;
use App\Domain\Repository\SegmentRepositoryInterface;
use App\Enums\StatusEnums;
use Illuminate\Support\Facades\Log;

class SegmentService
{
    private $segmentRepository;
    private $diaryRepository;

    public function __construct(SegmentRepositoryInterface $segmentRepository, DiaryRepositoryInterface $diaryRepository)
    {
        $this->segmentRepository = $segmentRepository;
        $this->diaryRepository = $diaryRepository;
    }

    public function deleteDiarySegment(int $segmentId): int
    {
        Log::info('to delete segment id: ' . $segmentId);
        $deletedSegment = $this->segmentRepository->deleteById($segmentId);
        Log::info(json_encode($deletedSegment));
        $diaryCount = DiarySegment::where('diary_id', $deletedSegment->diary_id)->count();
        if ($diaryCount < 1) {
            Log::info('remained count: ' . $diaryCount);
            $this->diaryRepository->deleteById($deletedSegment->diary_id);
            return StatusEnums::SEGMENT_EMPTY;
        }
        return StatusEnums::SEGMENT_NOT_EMPTY;
    }

}
