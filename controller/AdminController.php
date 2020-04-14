<?php

use Framework\View;

class AdminController extends Controller {

    public function admin() {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        
        $user = $_SESSION['user'];

        return new View("admin", []);
    }
}