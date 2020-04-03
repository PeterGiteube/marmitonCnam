<?php

use Framework\View;

class ProfileController extends Controller {

    public function profile() {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $user = $_SESSION['user'];

        return new View("profile", ['user' => $user]);
    }
}