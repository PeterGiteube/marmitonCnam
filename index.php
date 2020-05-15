<?php

use Framework\Helper\ViewHelperContainer;
use Framework\Http\RequestImp;
use Framework\Router;

require_once "config/autoloader.php";

try {
    $routes = include 'config/routing.php';

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

?>
