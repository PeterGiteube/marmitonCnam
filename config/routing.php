<?php

/** @noinspection PhpUnhandledExceptionInspection */

use Framework\Routing\RoutesBuilder;

$routes = new RoutesBuilder();

$routes->add("marmiton_home", "/")
    ->controller(new HomeController(), "home")
    ->methods(['GET']);

$connexionController = new ConnexionController();

$routes->add("marmiton_login", "/login")
    ->controller($connexionController, "login")
    ->methods(['GET', 'POST']);

$routes->add("marmiton_logout", "/logout")
    ->controller($connexionController, "logout")
    ->methods(['GET']);

$routes->add("marmiton_profile", "/profile")
    ->controller(new ProfileController(), "profile")
    ->methods(['GET']);

$routes->add("marmiton_registration", "/registration")
    ->controller(new RegistrationController(), "registration")
    ->methods(['POST', 'GET']);

return $routes->build();