<?php

namespace App\Controllers;

use App\Services\RequestService;

class MainContentController {

    public static function content($payload)
    {
        $content = $payload->content;
    }
}
