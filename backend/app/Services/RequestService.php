<?php

namespace App\Services;

class RequestService {

    public static function methodVerify(String $allowedRequestMethod): Bool
    {
        if($_SERVER['REQUEST_METHOD'] !== $allowedRequestMethod) {
            return self::httpError(400, 'Bad Request');
        }
        return true;
    }

    public static function httpError(Int $errorCode, String $message)
    {
        http_response_code($errorCode);
        header('Content-Type: text/plain');
        echo $message;

        return false;
    }
}
