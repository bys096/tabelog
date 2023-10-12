<?php

namespace App\Domain\Repository;

interface HashTagRepositoryInterface
{
    public function findByTagName(string $tagName);

    public function createHashTag(string $tagName);

}
