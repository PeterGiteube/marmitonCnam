<?php

namespace Framework\Routing;

use Exception;
use Framework\Configuration;
use ReflectionClass;
use ReflectionException;

class RoutesBuilder {

    /**
     * @var Route[]
     */
    private $routes;

    /**
     * @var Route
     */
    private $pendingRoute;

    public function __construct()
    {
        $this->routes = [];
    }

    public function add($name, $path) {
        $this->checkPendingRoute();

        $route = new Route();
        $route->setName($name);
        $route->setPath(Configuration::get('index') . $path);

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

        $this->pendingRoute->setController(['class_instance' => $controllerInstance, "controller" => $methodName]);
        return $this;
    }

    public function build() {
        $staticRoutes = array_filter($this->routes, function($element) {
           return strpos($element->getPath(), ':') === false;
        });

        $dynamicRoutes = array_filter($this->routes, function($element) {
            return strpos($element->getPath(), ':') !== false;
        });

        return array_merge($staticRoutes, $dynamicRoutes);
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