<?php

use Framework\View;

class ValidateRecipeController extends Controller {
    public function validateRecipe() {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $user = $_SESSION['user'];

        return new View("validateRecipe", []);
    }
}