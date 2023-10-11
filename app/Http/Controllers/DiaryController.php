<?php

namespace App\Http\Controllers;

use App\Domain\DTO\DiaryStoreRequestDTO;
use App\Domain\DTO\DiaryUpdateRequestDTO;
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
        return $this->diaryService->findDiaries($userId);
//        Log::info(serialize($record));
    }


    // 新しいDAIRYの作成
    public function store(Request $request)
    {
        $userId = auth()->id();
        Log::info('date: ' . $request->input('date'));
        Log::info('date: ' . $request->input('content'));
        Log::info('date: ' . $request->input('meal_time'));
        $diaryDTO = new DiaryStoreRequestDTO($request->input('content'), $request->input('date'), $request->input('meal_time'));
        Log::info('Diary Accept: ' . json_encode($diaryDTO));

        $this->diaryService->storeDiary($userId, $diaryDTO);
        return redirect()->route('dashboard');

    }

    public function saveImage(Request $request)
    {
        Log::info('diarySave method');
        if ($request->hasFile('image')) {
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            Log::info($fileName);
            $imagePath = $request->file('image')->storeAs('public/images', $fileName);
            return response()->json([
                "imageUrl" => 'http://localhost:8090/storage/images/' . $fileName
            ]);
        }
    }

    // Diary削除
    public function destroy($diaryId)
    {
        $this->diaryService->deleteDiary($diaryId);
    }


    // Diary修正
    public function update(Request $request, int $diaryId)
    {
        $dto = new DiaryUpdateRequestDTO(
            $request->input('title'),
            $request->input('content')
        );
        $this->diaryService->updateDiary($diaryId, $dto);
    }

}
