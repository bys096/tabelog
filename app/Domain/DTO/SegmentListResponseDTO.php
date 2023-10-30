<?php

namespace App\Domain\DTO;

class

SegmentListResponseDTO
{
    private $dtoList;
    private $user;

    /**
     * @param $dtoList
     * @param $user
     */
    public function __construct($dtoList, $user)
    {
        $this->dtoList = $dtoList;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDtoList()
    {
        return $this->dtoList;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}
