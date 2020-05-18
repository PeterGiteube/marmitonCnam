<?php /** @noinspection PhpIncludeInspection */

return function($class) {
    $pathToController = __DIR__ . '/../controller/' . $class . '.php';
    $pathToDao = __DIR__ . '/../dao/' . $class . '.php';
    $pathToModel = __DIR__ . '/../model/' . $class . '.php';

    if(file_exists($pathToController)) {
        require_once $pathToController;
    } else if( file_exists($pathToDao)) {
        require_once $pathToDao;
    } else if ( file_exists($pathToModel)) {
        require_once $pathToModel;
    }
};