<?php

namespace App\Domain\Repository;

use App\Domain\DTO\DiaryStoreRequestDTO;
use App\Domain\Entity\Diary;
use App\Domain\Models\Diary as EloquentDiary;
use App\Domain\Models\User;

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

    public function storeDiary(User $user, DiaryStoreRequestDTO $dto): int
    {
//        $eloquent = $this->eloquentDiary->newInstance();
//        $eloquent->title = $diary->getTitle();
//        $eloquent->content = $diary->getContent();
//        $eloquent->save();
        $newDiary = $user->diaries()->create([
            'title' => $dto->getTitle(),
            'content' => $dto->getContent()
        ]);

        return $newDiary->id;
    }
}
