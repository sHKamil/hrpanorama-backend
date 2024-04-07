<?php

namespace App\Services;

class RequestService {

    public static function methodVerify(String $allowedRequestMethod): Bool
    {
        if($_SERVER['REQUEST_METHOD'] !== $allowedRequestMethod) {
            return self::httpResponse(400, 'Bad Request');
        }
        return true;
    }
    
    public static function httpResponse(Int $responseCode, String $message)
    {
        http_response_code($responseCode);
        header('Content-Type: application/json');
        echo $message;
        exit;
    }
}
