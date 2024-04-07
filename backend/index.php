<?php

require 'vendor/autoload.php';

header("Access-Control-Allow-Origin: *");

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$router = new App\Router\Router;
$routes = require_once 'app/Router/web.php';
echo $router->route($uri);
