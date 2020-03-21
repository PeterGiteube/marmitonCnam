<?php

class Router {

    private $routes;

    private $connexionController;
    private $homeController;

    public function __construct($routes)
    {
        $this->routes = $routes;

        $this->connexionController = new ConnexionController();
        $this->homeController = new HomeController();
    }

    public function request() {
        $uri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();

        $route = $this->getRouteFromURI($uri);

        if($route != null) {
            $params = ['POST' => [], 'GET' => []];
            $caller = $route->getController()['controller'];

            if(in_array($requestMethod, $route->getMethods())) {
                if ($requestMethod == 'GET') {
                    $params['GET'] = $_GET;
                }

                if ($requestMethod == 'POST') {
                    $params['POST'] = $_POST;
                }

                $caller($params);
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