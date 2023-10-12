<?php

namespace App\Domain\DTO;

use Carbon\Carbon;

class DiaryStoreRequestDTO
{
    public $content;
    public $diaryId;

    public $date;

    public $mealTime;

    public $hashTagList;

    /**
     * @param $content
     * @param $date
     * @param $mealTime
     * @param $hashTagList
     */
    public function __construct($content, $date, $mealTime, $hashTagList)
    {
        $this->content = $content;
        $this->date = $date;
        $this->mealTime = $mealTime;
        $this->hashTagList = $hashTagList;
    }


    /**
     * @return mixed
     */
    public function getHashTagList()
    {
        return $this->hashTagList;
    }





    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getDiaryId()
    {
        return $this->diaryId;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getMealTime()
    {
        return $this->mealTime;
    }




}
