<?php

namespace App\Services;

use App\Services\RequestService;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService {
    private $secretKey;

    public function __construct($secretKey) {
        $this->secretKey = $secretKey;
    }

    public function generateToken(String $username)
    {
        $token = [
                "data" => [
                    "username" => $username
                ]
            ];

        return JWT::encode($token, $this->secretKey, 'HS256');
    }

    function verifyToken($token) {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function authorize(Bool | Null $authorization)
    {
        if($authorization === true) {
            $token = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
            $token = str_replace('Bearer ', '', $token);
            $payload = $this->verifyToken($token);
            if ($payload) {
                return $payload;
            } else {
                RequestService::httpError(401, "Unauthorized");
            }
        }

    }


}
