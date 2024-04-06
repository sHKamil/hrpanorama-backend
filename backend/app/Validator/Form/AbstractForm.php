<?php

namespace App\Validator\Form;

abstract class AbstractForm {

    public static function textField(String $text, Int $min = 3, Int $max = 200) : Bool
    {
        if(strlen($text) >= $max) return false;
        if(strlen($text) <= $min) return false;

        return true;
    }
}