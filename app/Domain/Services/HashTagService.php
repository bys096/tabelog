<?php

namespace App\Domain\Services;

use App\Domain\DTO\DiaryStoreRequestDTO;
use App\Domain\Repository\HashTagRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HashTagService
{
    private $hashTagRepository;

    public function __construct(HashTagRepositoryInterface $hashTagRepository)
    {
        $this->hashTagRepository = $hashTagRepository;
    }

    public function registerHashTags(DiaryStoreRequestDTO $dto, int $diarySegmentId)
    {
        $hashTagList = $dto->getHashTagList();

        foreach ($hashTagList as $tagName) {
            Log::info($tagName);
            DB::transaction(function () use ($tagName, $dto, $diarySegmentId) {
                try {
                    $hashTag = $this->hashTagRepository->findByTagName($tagName);
                    if (!$hashTag) {     // 新しいHashTagなら作成してから、HashTagとSegmentをタッグする。
                        $hashTag = $this->hashTagRepository->createHashTag($tagName);
                    }
//                    $hashTag->diarySegments()->sync([$diarySegmentId]);
                    $hashTag->diarySegments()->attach($diarySegmentId);
                } catch (\Exception $e) {
                    Log::error($e);
                }
            }, 5);
        }

    }

}
