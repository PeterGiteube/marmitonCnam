<?php

namespace Framework\Helper;

use Closure;
use Framework\Routing\Route;

class RoutePathHelper implements ViewHelperInterface {

    /**
     * @var Route[]
     */
    public $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }


    public function getName() : string
    {
        return "path";
    }

    public function getHelper() : Closure
    {
        return function($routeName) {
            $EMPTY_STRING = "";

            foreach ($this->routes as $route) {
                if($route->getName() == $routeName) {
                    return $route->getPath();
                }
            }

            return $EMPTY_STRING;
        };
    }

}