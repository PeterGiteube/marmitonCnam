<?php

namespace Framework;

use Framework\Controller\ControllerInvoker;
use Framework\Http\RequestImp;
use Framework\Routing\UrlMatcher;

class Router {

    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function handle(RequestImp $request) {
        $this->startSession();
        
        $view = new View('404', []);
        $roleChecker = new RoleChecker();

        $queryUrl = $request->url();

        $matchingRoute = $this->getMatchingRoute($queryUrl);

        if($matchingRoute != null) {

            $requestMethod = $request->method();

            if ($this->requestMethodValid($requestMethod, $matchingRoute)) {

                $arguments = $this->getRouteArguments($matchingRoute, $queryUrl);
                $request->setRouteArguments($arguments);

                $invoker = new ControllerInvoker($matchingRoute->getController());
                $invoker->prepareRoleCheckerInjection($roleChecker);

                $view = $invoker->invoke($request);

            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(404);
        }

        $view->setRoleChecker($roleChecker);
        $view->render();
    }

    private function getMatchingRoute($queryUrl) {
        foreach ($this->routes as $route) {
            $matcher = $this->getMatcherForCurrentRoute($route);

            if($matcher->match($queryUrl))
                return $route;
        }

        return null;
    }

    private function getRouteArguments($matchingRoute, $queryUrl) {
        $matcher = $this->getMatcherForCurrentRoute($matchingRoute);

        return $matcher->extract($queryUrl);
    }

    private function getMatcherForCurrentRoute($route) {
        $urlPattern = $route->getPath();
        return new UrlMatcher($urlPattern);
    }

    private function requestMethodValid($requestMethod, $route) {
        return in_array($requestMethod, $route->getMethods());
    }

    private function startSession() {
        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();
    }
}