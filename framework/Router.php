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
            $caller = $route->getController()['controller'];

            if(in_array($requestMethod, $route->getMethods())) {
                $request = $this->createRequest($uri);

                $this->preventUsingSuperglobals();

                $caller($request);
            } else {
                $this->display404();
            }
        } else {
            $this->display404();
        }
    }

    private function createRequest($uri) {
        $body = file_get_contents('php://input');

        return [
            'POST' => $_POST,
            'GET' => $_GET,
            'body' => $body,
            'uri' => $uri,
        ];
    }

    private function preventUsingSuperglobals() {
        $_POST = [];
        $_GET = [];
    }

    private function display404() {
        http_response_code(404);
        $view = new View('404');
        $view->render([]);
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