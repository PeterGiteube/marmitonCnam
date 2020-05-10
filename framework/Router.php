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
        $authorizationChecker = new RoleChecker();

        $queryUrl = $request->url();
        $matchingRoute = null;

        foreach ($this->routes as $route) {
            $urlPattern = $route->getPath();
            $matcher = new UrlMatcher($urlPattern);

            if($matcher->match($queryUrl)) {
                $arguments = $matcher->extract($queryUrl);
                $request->setRouteArguments($arguments);

                $matchingRoute = $route;
                break;
            }
        }

        if($matchingRoute == null) {
            http_response_code(404);
        } else {
            if ($this->requestMethodValid($request->method(), $matchingRoute)) {
                $invoker = new ControllerInvoker($matchingRoute->getController());
                $invoker->prepareRoleCheckerInjection($authorizationChecker);

                $view = $invoker->invoke($request);

            } else {
                http_response_code(404);
            }
        }

        $view->setRoleChecker($authorizationChecker);
        $view->render();
    }

    private function requestMethodValid($requestMethod, $route) {
        return in_array($requestMethod, $route->getMethods());
    }

    private function startSession() {
        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();
    }
}