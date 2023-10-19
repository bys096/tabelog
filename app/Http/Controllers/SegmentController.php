<?php

namespace App\Http\Controllers;

use App\Domain\Services\SegmentService;
use App\Enums\StatusEnums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SegmentController extends Controller
{
    private $segmentService;

    public function __construct(SegmentService $segmentService)
    {
        $this->segmentService = $segmentService;
    }

    public function destroy(Request $request, int $segmentId)
    {
        Log::info('To Delete Segment By segmentId: ' . $segmentId);
        $status = $this->segmentService->deleteDiarySegment($segmentId);
        if($status == StatusEnums::SEGMENT_NOT_EMPTY) {
            Log::info('segment is not empty. so back to segment list.');
            return back();
        }
        Log::info('diary is empty.');
        return redirect()->route('diary.index');
    }
}
