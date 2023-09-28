<?php

namespace App\Http\Controllers;

use App\Domain\DTO\DiaryStoreRequestDTO;
use Illuminate\Http\Request;
use App\Domain\Services\DiaryService;
use Illuminate\Support\Facades\Log;
use function MongoDB\BSON\toJSON;

class DiaryController extends Controller
{
    private $diaryService;

    public function __construct(DiaryService $diaryService)
    {
        $this->diaryService = $diaryService;
    }

    // 自分が書いたDIARYを検索
    public function index()
    {
        $userId = auth()->id();
//        Log::info('라라벨 사용자 id: ' . $userId);
        return $this->diaryService->findDiaries($userId);
//        Log::info(serialize($record));
    }

    // 新しいDAIRYの作成
    public function store(Request $request)
    {
        $userId = auth()->id();
        $diaryDTO = new DiaryStoreRequestDTO();
        $diaryDTO->setTitle($request->input('title'));
        $diaryDTO->setContent($request->input('content'));

        $this->diaryService->storeDiary($userId, $diaryDTO);

    }

    // DIARY削除
    public function destroy($diaryId)
    {
        $this->diaryService->deleteDiary($diaryId);
    }
}
