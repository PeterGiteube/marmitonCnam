<?php

use Framework\Http\RequestImp;
use Framework\Router;

require_once "config/autoloader.php";

try {
    $routes = include 'config/routing.php';
    $router = new Router($routes);

    $request = RequestImp::createFromGlobals();
    $router->handle($request);

} catch (Exception $ex)  {
    echo $ex->getMessage();
}

?>
