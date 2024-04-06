<?php

namespace App\Controllers;

use App\Services\RequestService;
use App\Services\LoginService;
use App\Validator\LoginValidator;

class MainContentController {

    public static function index()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(RequestService::methodVerify("POST") && LoginValidator::validate($username, $password)){
            new LoginService($username, $password);
            
            return 'echo';
        }
    }
}
