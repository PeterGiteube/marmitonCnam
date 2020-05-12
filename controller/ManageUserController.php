<?php

use Framework\View;

class ManageUserController extends Controller {
    public function manageUser() {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $user = $_SESSION['user'];

        $userDao = new UserDao();

        return new View("manageUser", ["requestUser" => $userDao->getUsers()]);
    }
}