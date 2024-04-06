<?php

use Firebase\JWT\JWT;

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

}
