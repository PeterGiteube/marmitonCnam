<?php

use Framework\Routing\RoutesBuilder;

return function(RoutesBuilder $routes) {

    $routes->add("marmiton_home", "/")
        ->controller([HomeController::class, "home"])
        ->methods(['GET']);

    $routes->add("marmiton_login", "/login")
        ->controller([ConnexionController::class, "login"])
        ->methods(['GET', 'POST']);

    $routes->add("marmiton_logout", "/logout")
        ->controller([ConnexionController::class, "logout"])
        ->methods(['GET']);

    $routes->add("marmiton_profile", "/profile")
        ->controller([ProfileController::class, "profile"])
        ->methods(['GET']);

    $routes->add("marmiton_registration", "/registration")
        ->controller([RegistrationController::class, "registration"])
        ->methods(['GET', 'POST']);

    $routes->add("marmiton_administration", "/admin")
        ->controller([AdminController::class, "admin"])
        ->methods(['GET']);

    $routes->add("marmiton_waiting_recipe", "/admin/recipes/waiting")
        ->controller([RecipeController::class, "waiting"])
        ->methods(['GET']);

    $routes->add("marmiton_validate_recipe", "/admin/recipes/validate")
        ->controller([RecipeController::class, "validate"])
        ->methods(['GET']);

    $routes->add("marmiton_manage_user", "/admin/users/manage")
        ->controller([ManageUserController::class, "manage"])
        ->methods(['GET']);
};