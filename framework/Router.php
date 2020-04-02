<?php

namespace Framework;

class Router {

    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function request() {
        $this->startSession();

        $uri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $view = new View('404', []);

        $authorizationChecker = new RoleChecker();

        if($this->routeIsValid($uri)) {
            $route = $this->getRoute($uri);

            $controllerInvoker = $route->getController()['controller'];
            $controllerInstance = $route->getController()['class_instance'];
            if(is_subclass_of($controllerInstance, 'Controller')) {
                $controllerInstance->setAuthorizationChecker($authorizationChecker);
            }

            if($this->requestMethodValid($requestMethod, $route)) {
                $request = $this->createRequest($uri);

                /** @var View $view */
                $view = $controllerInvoker($request);
            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(404);
        }

        $view->setAuthorizationChecker($authorizationChecker);
        $view->render();
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

    private function requestMethodValid($requestMethod, $route) {
        return in_array($requestMethod, $route->getMethods());
    }

    private function routeIsValid($uri) {
        foreach ($this->routes as $route) {
            $path = $route->getPath();
            if($path == $uri) {
                return true;
            }
        }

        return false;
    }

    private function getRoute($uri) {
        $result = array_filter($this->routes, function($element) use(&$uri) {
            return $element->getPath() == $uri;
        });

        $values = array_values($result);

        return $values[0];
    }

    private function startSession() {
        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();
    }
}