<?php

namespace App\Domain\Repository;

interface SegmentRepositoryInterface
{
    public function deleteById(int $segmentId);

}
