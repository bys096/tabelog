<?php

namespace App\Domain\Repository;

use App\Domain\DTO\DiaryStoreRequestDTO;
use App\Domain\DTO\DiaryUpdateRequestDTO;
use App\Domain\Entity\Diary;
use App\Domain\Models\Diary as EloquentDiary;
use App\Domain\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DiaryRepository implements DiaryRepositoryInterface
{

    private $eloquentDiary;

    public function __construct(EloquentDiary $eloquentDiary)
    {
        $this->eloquentDiary =  $eloquentDiary;
    }

    public function findByUserId(int $userId): ?Diary
    {
        $record = $this->eloquentDiary->where('user_id', $userId)->first();

        if ($record == null) {
            return null;
        }

        return new Diary(
            $record->id,
            $record->title,
            $record->content,
            $record->user_id,
            $record->created_at,
            $record->updated_at
        );
    }

    public function storeDiary(User $user): int
    {
//        $eloquent = $this->eloquentDiary->newInstance();
//        $eloquent->title = $diaries->getTitle();
//        $eloquent->content = $diaries->getContent();
//        $eloquent->save();
        $newDiary = $this->eloquentDiary->create([
            'date' => Carbon::now()->toDateString(),
            'user_id' => $user->id
        ]);

        return $newDiary->id;
    }

    public function deleteById(int $diaryId)
    {
        $diary = $this->eloquentDiary->where('id', $diaryId);
        return $diary->delete();
    }


    public function saveDiary(EloquentDiary $eloquentDiary)
    {
        $eloquentDiary->save();
    }

    public function findById(int $diaryId)
    {
        return $this->eloquentDiary->where('id', $diaryId)->first();
    }


    public function findByCreatedAt(string $date)
    {
        Log::info('repository find 중: ' . $date);

        $diary = $this->eloquentDiary->where('date', $date)->first();
        return $diary;
    }
}
