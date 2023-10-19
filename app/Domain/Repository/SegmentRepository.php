<?php

namespace App\Domain\Repository;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Domain\Models\DiarySegment as EloquentSegment;

class SegmentRepository implements SegmentRepositoryInterface
{
    private $eloquentSegment;

    public function __construct(EloquentSegment $eloquentSegment)
    {
        $this->eloquentSegment = $eloquentSegment;
    }

    public function deleteById(int $segmentId)
    {
        try {
            $segment = $this->eloquentSegment->where('id', $segmentId)->first();
            $diaryId = $segment->dairy_id;
            $segment->hashTags()->detach();
            Log::info('피벗 삭제 성공');
            $segment->delete();
//            $diaryCount = $this->eloquentSegment->where('diary_id', $diaryId)->count();
            return $segment;

        } catch(QueryException $e) {
            Log::error($e);
        }

    }
}
