<?php

namespace App\Validator;

use App\Validator\Form\AbstractForm;

class LoginValidator extends AbstractForm {

    public static function validate(String $username, String $password) : Bool | Array
    {
        $buffer = [];
        $buffer = self::usernameField($username, $buffer);
        $buffer = self::passwordField($password, $buffer);
        
        if(!empty($buffer)) return $buffer;

        return true;
    }

    private static function usernameField(String $username, Array $buffer) : Array
    {
        if(!self::textField($username, 5)) $buffer['username'] = 'Incorrect username lenght.';
        return $buffer;
    }
    
    private static function passwordField(String $password, Array $buffer) : Array
    {
        if(self::textField($password, 8)) $buffer['password'] = 'Incorrect password lenght.';
        return $buffer;
    }
}
