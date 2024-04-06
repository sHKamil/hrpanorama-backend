<?php

namespace App\Services;

class LoginService {
    private $username;
    private $password;

    public function __construct(String $username, String $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function authUser() : Bool // HARDCODED username and pass
    {
        if($this->username === 'user' && $this->password === 'password') return true;
        return false;
    }

}