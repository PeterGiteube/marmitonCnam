<?php

require_once "config/autoloader.php";

try {
    $router = new Router();
    $router->request();

} catch (Exception $ex)  {
    echo $ex->getMessage();
}

?>
