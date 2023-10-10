<?php

namespace App\Domain\DTO;

use Carbon\Carbon;

class DiaryStoreRequestDTO
{
    private $title;
    private $content;

    private $diaryId;

    /**
     * @return mixed
     */
    public function getDiaryId()
    {
        return $this->diaryId;
    }

    /**
     * @param mixed $diaryId
     */
    public function setDiaryId($diaryId): void
    {
        $this->diaryId = $diaryId;
    }

    /**
     * @param $title
     * @param $content
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }




}
