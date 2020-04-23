<?php

use Framework\View;

class WaitingRecipeController extends Controller {

    public function waitingRecipe() {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $user = $_SESSION['user'];

        return new View("waitingRecipe", []);
    }
}