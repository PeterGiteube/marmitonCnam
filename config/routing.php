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

    $routes->add("marmiton_profile_info", "/profile/info/update")
        ->controller([ProfileController::class, "updateInfo"])
        ->methods(['POST']);

    $routes->add("marmiton_profile_security", "/profile/security/update")
        ->controller([ProfileController::class, "updateSecurity"])
        ->methods(['POST']);

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

    $routes->add("marmiton_add_user","/admin/user/add")
        ->controller([UserController::class, "add"])
        ->methods(['GET','POST']);

    $routes->add("marmiton_edit_user", "/admin/user/:id/edit")
        ->controller([UserController::class, "edit"])
        ->methods(['GET']);

    $routes->add("marmiton_update_user", "/admin/user/:id/update")
        ->controller([UserController::class, "update"])
        ->methods(['POST']);

    $routes->add("marmiton_delete_user", "/admin/user/delete")
        ->controller([UserController::class, "delete"])
        ->methods(['POST']);

    $routes->add("marmiton_add_recipe", "/admin/recipe/add")
        ->controller([RecipeController::class, "add"])
        ->methods(['GET','POST']);

    $routes->add("marmiton_delete_recipe", "/admin/recipe/delete")
        ->controller([RecipeController::class, "delete"])
        ->methods(['GET', 'POST']);

    $routes->add("marmiton_edit_recipe", "/admin/recipe/:id/edit")
        ->controller([RecipeController::class, "edit"])
        ->methods(['GET']);

    $routes->add("marmiton_update_recipe", "/admin/recipe/:id/update")
        ->controller([RecipeController::class, "update"])
        ->methods(['POST', 'GET']);

    $routes->add("marmiton_get_ingredient","/admin/recipe/get/ingredient")
        ->controller([IngredientController::class, "list"])
        ->methods(['GET']);

    $routes->add("marmiton_delete_ingredient", "/admin/recipe/delete/ingredient")
        ->controller([RecipeIngredientController::class, "delete"])
        ->methods(['GET', 'POST']);

    $routes->add("marmiton_delete_step", "/admin/recipe/delete/step")
        ->controller([StepController::class, "delete"])
        ->methods(['GET', 'POST']);

    $routes->add("marmiton_add_ingredient", "/admin/ingredients/add")
        ->controller([IngredientController::class, "add"])
        ->methods(['GET', 'POST']);

    $routes->add("marmiton_manage_ingredient", "/admin/ingredients/manage")
        ->controller([ManageIngredientController::class, "manage"])
        ->methods(['GET']);

    $routes->add("marmiton_manage_ingredient", "/admin/ingredient/delete")
        ->controller([IngredientController::class, "delete"])
        ->methods(['POST']);

    $routes->add("marmiton_manage_ingredient", "/admin/ingredient/:id/edit")
        ->controller([IngredientController::class, "edit"])
        ->methods(['POST', 'GET']);

    $routes->add("marmiton_update_recipe", "/admin/ingredient/:id/update")
        ->controller([IngredientController::class, "update"])
        ->methods(['POST', 'GET']);

    $routes->add("marmiton_confirm_registration", "/registration/confirm")
        ->controller([RegistrationController::class, "confirm"])
        ->methods(['GET']);

    $routes->add("marmiton_confirm_registration", "/recipe/:id/consult")
        ->controller([RecipeController::class, "consult"])
        ->methods(['GET']);

    $routes->add("marmiton_user_recipe", "/user/my-recipes")
        ->controller([UserController::class, "consultRecipesUser"])
        ->methods(['GET']);

    $routes->add("marmiton_user_create_recipe", "/user/create-recipe")
        ->controller([RecipeController::class, "add"])
        ->methods(['GET']);

    $routes->add("marmiton_user_recipe", "/recipe/:id/consult")
        ->controller([RecipeController::class, "consultRecipeUser"])
        ->methods(['GET']);
};