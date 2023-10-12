<?php

namespace App\Domain\Repository;

use App\Domain\Models\HashTag as EloquentHashTag;
class HashTagRepository implements HashTagRepositoryInterface
{
    private $eloquentHashTag;

    public function __construct(EloquentHashTag $eloquentHashTag)
    {
        $this->eloquentHashTag = $eloquentHashTag;
    }

    public function findByTagName(string $tagName)
    {
        return $this->eloquentHashTag->where('tag_name', $tagName)->first();
    }

    public function createHashTag(string $tagName)
    {
        return $this->eloquentHashTag->create(['tag_name' => $tagName]);
    }
}
