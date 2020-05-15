<?php

namespace Framework;

use Framework\Controller\ControllerInvoker;
use Framework\Http\RequestImp;
use Framework\Routing\Route;
use Framework\Routing\UrlMatcher;
use Framework\Http\Response;

class Router {

    /**
     * @var Route[]
     */
    private $routes;

    /**
     * @var ControllerInvoker
     */
    private $invoker;

    public function __construct($routes, $controllerInvoker)
    {
        $this->routes = $routes;
        $this->invoker = $controllerInvoker;
    }

    public function handle(RequestImp $request) {
        $this->startSession();

        $response = Response::view('404', []);
        $response->setStatusCode(Response::HTTP_NOT_FOUND);

        $queryUrl = $request->url();
        $matchingRoute = $this->getMatchingRoute($queryUrl);

        if($matchingRoute != null) {

            $requestMethod = $request->method();

            if ($this->requestMethodValid($requestMethod, $matchingRoute)) {

                $arguments = $this->getRouteArguments($matchingRoute, $queryUrl);
                $request->setRouteArguments($arguments);

                $this->invoker->prepare($matchingRoute->getController());
                $response = $this->invoker->invoke($request);

            }
        }

        $response->send();
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