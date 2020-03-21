<?php

$builder = new RoutesBuilder();

$builder->addRoute("marmiton_home", "/")
    ->controller(new HomeController(), "home")
    ->methods(['GET']);

$builder->addRoute("marmiton_login", "/login")
    ->controller(new ConnexionController(), "connexion")
    ->methods(['GET', 'POST']);

$builder->addRoute("marmiton_login", "/logout")
    ->controller(new ConnexionController(), "logout")
    ->methods(['GET']);

return $builder->build();

?>