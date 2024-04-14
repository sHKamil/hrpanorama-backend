<?php

require 'vendor/autoload.php';

header( "Access-Control-Allow-Origin: *" );
header( 'Access-Control-Allow-Credentials: true' );
header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS' );
if ( isset( $_SERVER['REQUEST_METHOD'] ) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Content-Length, Accept, Authorization' );
    header( 'Access-Control-Max-Age: 86400' );
    header( 'Cache-Control: public, max-age=86400' );
    header( 'Vary: origin' );
    // exit( 0 );
}

const BASE_PATH = __DIR__ . '/';
require_once 'helpers/base_path.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$router = new App\Router\Router;
$routes = require_once 'app/Router/web.php';
echo $router->route($uri);
