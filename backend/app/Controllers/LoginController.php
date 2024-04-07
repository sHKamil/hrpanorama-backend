<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\LoginService;
use App\Validator\LoginValidator;

class LoginController {

    public static function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(LoginValidator::validate($username, $password)){
            $loginService = new LoginService($username, $password);
            if($loginService->authUser()) {
                $authService = new AuthService('HARDCODED');
                return json_encode([
                    'status' => '200',
                    "token" => $authService->generateToken($username)
                ]);
            }

            return json_encode([
                'status' => '401',
                'message' => 'Wrong name or password'
            ]);
        }
    }
}
