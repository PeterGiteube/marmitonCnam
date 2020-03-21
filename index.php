<?php

require_once "config/autoloader.php";

try {
    $routes = include 'config/routing.php';

    $router = new Router($routes);
    $router->request();

} catch (Exception $ex)  {
    echo $ex->getMessage();
}

?>
