<?php

namespace App\Enums;


enum ErrorCode
{
    case DUPLICATE_USER_EXCEPTION;

    public function errorCode(): string
    {
        return match($this) {
            self::DUPLICATE_USER_EXCEPTION => 'U001',
        };
    }

    public function message(): string
    {
        return match($this) {
            self::DUPLICATE_USER_EXCEPTION => '유저 중복 에러 발생!'
        };
    }

}
