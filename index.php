<?php

use Framework\Helper\ViewHelperContainer;
use Framework\Http\RequestImp;
use Framework\Router;
use Framework\Routing\RoutesBuilder;

try {
    loadClasses();

    $wrapper = include "config/routing.php";
    $routes = loadRoutes($wrapper);

    $roleChecker = new \Framework\RoleChecker();

    ViewHelperContainer::append([
        'role_checker' => new \Framework\Helper\RoleCheckHelper($roleChecker),
        'route_path' => new \Framework\Helper\RoutePathHelper($routes)
    ]);

    $controllerInvoker = new \Framework\Controller\ControllerInvoker();
    $controllerInvoker->setRoleChecker($roleChecker);

    $router = new Router($routes, $controllerInvoker);

    $request = RequestImp::createFromGlobals();
    $router->handle($request);

} catch (Exception $ex)  {
    echo $ex->getMessage();
}

function loadRoutes($wrapperClosure) {
    $routeBuilder = new RoutesBuilder();

    $wrapperClosure($routeBuilder);

    return $routeBuilder->build();
}

function loadClasses() {

    // Specific app loader
    if(file_exists("config/autoloader.php")) {
        $loader = include "config/autoloader.php";
        spl_autoload_register($loader);
    }

    // Framework loader
    spl_autoload_register(function($class) {
        $path = str_replace('\\', '/', $class);
        $segments = explode('/', $path);

        for($i = 0; $i < count($segments) - 1; $i++) {
            $segments[$i] = strtolower($segments[$i]);
        }

        $path = implode('/', $segments);

        include $path . '.php';
    });
}

?>


