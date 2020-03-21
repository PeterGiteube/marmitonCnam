<?php

/** @noinspection PhpUnhandledExceptionInspection */

use Framework\Routing\RoutesBuilder;

$routes = new RoutesBuilder();

$routes->add("marmiton_home", "/")
    ->controller(new HomeController(), "home")
    ->methods(['GET']);

$routes->add("marmiton_login", "/login")
    ->controller(new ConnexionController(), "connexion")
    ->methods(['GET', 'POST']);

$routes->add("marmiton_logout", "/logout")
    ->controller(new ConnexionController(), "logout")
    ->methods(['GET']);

return $routes->build();