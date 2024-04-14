<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\LoginService;
use App\Services\RequestService;
use App\Validator\LoginValidator;

class LoginController {

    public static function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $username = $data['username'];
        $password = $data['password'];

        if(LoginValidator::validate($username, $password)){
            $loginService = new LoginService($username, $password);
            if($loginService->authUser()) {
                $authService = new AuthService('HARDCODED'); // Should be extracted from .env
                return RequestService::httpResponse(200, json_encode([
                    'status' => '200',
                    "token" => $authService->generateToken($username)
                ]));
            }

            return RequestService::httpResponse(403, json_encode([
                'message' => 'Wrong name or password'
            ]));
        }
        return RequestService::httpResponse(200, json_encode([
                'message' => 'Wrong name or password'
            ]));
        }
}
