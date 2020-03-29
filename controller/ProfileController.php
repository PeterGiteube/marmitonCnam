<?php

use Framework\View;

class ProfileController extends Controller {

    public function profile() {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $user = $_SESSION['user'];

        $view = new View("profile");
        $view->render(['user' => $user]);
    }
}