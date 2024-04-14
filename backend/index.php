<?php

require 'vendor/autoload.php';


  // print needed allowed origins
  header( "Access-Control-Allow-Origin: *" );
  header( 'Access-Control-Allow-Credentials: true' );
  header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS' );
  
  // chrome and some other browser sends a preflight check with OPTIONS
  // if that is found, then we need to send response that it's okay
  // @link https://stackoverflow.com/a/17125550/2754557
  if (
    isset( $_SERVER['REQUEST_METHOD'] )
    && $_SERVER['REQUEST_METHOD'] === 'OPTIONS'
  ) {
    // need preflight here
    header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Content-Length, Accept, Authorization' );
    // add cache control for preflight cache
    // @link https://httptoolkit.tech/blog/cache-your-cors/
    header( 'Access-Control-Max-Age: 86400' );
    header( 'Cache-Control: public, max-age=86400' );
    header( 'Vary: origin' );
    // just exit and CORS request will be okay
    // NOTE: We are exiting only when the OPTIONS preflight request is made
    // because the pre-flight only checks for response header and HTTP status code.
    exit( 0 );
  }

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$router = new App\Router\Router;
$routes = require_once 'app/Router/web.php';
echo $router->route($uri);
