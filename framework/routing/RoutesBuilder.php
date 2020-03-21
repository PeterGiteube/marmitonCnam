<?php

class RoutesBuilder {

    private $routes;
    private $pendingRoute;

    public function __construct()
    {
        $this->routes = [];
    }

    public function addRoute($name, $path) {
        $this->checkPendingRoute();

        $route = new Route();
        $route->setName($name);
        $route->setPath($path);

        $this->pendingRoute = $route;
        array_push($this->routes, $route);

        return $this;
    }


    public function methods($methods) {
        if(empty($methods)) {
            throw new Exception("Methods argument array is empty");
        }

        if(!in_array('GET', $methods) && !in_array('POST', $methods)) {
            throw new Exception("Invalid(s) method(s)");
        }

        $this->pendingRoute->setMethods($methods);

        return $this;
    }

    public function controller($controllerInstance, $methodName) {
        if($controllerInstance == null) {
            throw new Exception("Controller can't be null");
        }

        try {
            $class = new ReflectionClass(get_class($controllerInstance));
            $reflectionMethod = $class->getMethod($methodName);

            $controller = function($params) use (&$reflectionMethod, $controllerInstance) {
                $reflectionMethod->invoke($controllerInstance, $params);
            };

            $this->pendingRoute->setController(['class_instance' => $controllerInstance, "controller" => $controller]);
        } catch (ReflectionException $e) {
            throw $e;
        }

        return $this;
    }

    public function getControllerFromRouteName($name) {
        foreach ($this->routes as $route)  {
            if($route->getName() == $name) {
                $controller = $route->getController();
                return $controller['class_instance'];
            }
        }

        throw new Exception("Controller doesn't exist");
    }

    public function build() {
        return $this->routes;
    }

    private function checkPendingRoute() {
        if($this->pendingRoute != null) {
            $currentRoute = $this->pendingRoute;

            if(empty($currentRoute->getController())) {
                array_pop($routes);
                return;
            }

            if(empty($currentRoute->getMethods())) {
                array_pop($routes);
                return;
            }
        }
    }

}