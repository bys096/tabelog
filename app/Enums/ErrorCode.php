<?php

namespace App\Enums;

use Symfony\Component\HttpFoundation\Response;

enum ErrorCode
{
    case DUPLICATE_USER_EXCEPTION;

    public function errorCode(): string
    {
        return match($this) {
            self::DUPLICATE_USER_EXCEPTION => 'U001',
//            Hoge::C1000 => 1000
        };
    }
    public function message(): string
    {
        return match($this) {
            self::DUPLICATE_USER_EXCEPTION => '유저 중복 에러 발생!'
//            Hoge::OK => "a",

        };
    }


}
