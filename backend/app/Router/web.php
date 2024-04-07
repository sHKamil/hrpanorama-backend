<?php

use App\Controllers\LoginController;
use App\Controllers\MainContentController;

$router->post('/', LoginController::class, 'login');

