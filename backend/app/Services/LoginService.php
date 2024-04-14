<?php

namespace App\Services;

use App\Database\Database;

class LoginService {
    private $username;
    private $password;
    private $db;

    public function __construct(String $username, String $password) {
        $this->username = $username;
        $this->password = $password;
        $this->db = new Database;
    }

    public function authUser() : Bool
    {
        $attempt = $this->db->query("SELECT username, password FROM users WHERE username = :username", [
            ':username' => $this->username,
        ]);
        if ($attempt->rowCount() === 1) {
            $data = $attempt->fetch();
            if(password_verify($this->password, $data['password'])) return true;
        }
        return false;
    }
}
