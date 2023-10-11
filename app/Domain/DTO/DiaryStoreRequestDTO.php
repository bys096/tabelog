<?php

namespace App\Domain\DTO;

use Carbon\Carbon;

class DiaryStoreRequestDTO
{
    public $content;
    public $diaryId;

    public $date;

    public $mealTime;

    /**
     * @param $content
     * @param $date
     * @param $mealTime
     */
    public function __construct($content, $date, $mealTime)
    {
        $this->content = $content;
        $this->date = $date;
        $this->mealTime = $mealTime;
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
