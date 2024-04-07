<?php

namespace App\Router;

use App\Services\RequestService;
use App\Services\AuthService;

class Router
{

    private $routes = [];

    public function add($uri, $class, $class_method, $method)
    {
        $this->routes [] = [
            'uri' => $uri,
            'class' => $class,
            'class_method' => $class_method,
            'method' => $method,
            'authorization' => NULL
        ];
        return $this;
    }

    public function get($uri, $class, $class_method)
    {
        return $this->add($uri, $class, $class_method, 'GET');
    }

    public function post($uri, $class, $class_method)
    {
        return $this->add($uri, $class, $class_method, 'POST');
    }

    public function onlyAuthorized()
    {
        $this->routes[array_key_last($this->routes)]['authorization'] = true;
    }
    
    public function route($uri)
    {
        foreach ($this->routes as $route)
        {
            if($route['uri'] === $uri)
            {
                if(RequestService::methodVerify($route['method'])) {
                    $authorization = new AuthService('HARDCODED');
                    $payload = $authorization->authorize($route['authorization']);
                    $class = new $route['class']();
                    if($payload) return call_user_func_array([$class, $route['class_method']], [$payload]);
                    return call_user_func([$class, $route['class_method']]);
                }
            }
        }
        return RequestService::httpError(404, 'Page not found');
    }
}