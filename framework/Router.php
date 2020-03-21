<?php

namespace Framework;

class Router {

    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function request() {
        $uri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();

        $route = $this->getRouteFromURI($uri);

        if($route != null) {
            $request = ['POST' => $_GET, 'GET' => $_POST, 'body' => ""];
            $caller = $route->getController()['controller'];

            if(in_array($requestMethod, $route->getMethods())) {
                $request['body'] = file_get_contents('php://input');

                $caller($request);
            } else {
                http_response_code(404);
                echo '404';
            }
        } else {
            http_response_code(404);
            echo '404';
        }
    }

    private function getRouteFromURI($uri) {
        $index = Configuration::get("index");
        foreach ($this->routes as $route) {
            $path = $index . $route->getPath();
            if($path == $uri) {
                return $route;
            }
        }

        return null;
    }

    private function error($msg) {
        echo $msg;
    }
}