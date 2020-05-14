<?php

use Framework\Controller\Controller;
use Framework\View;

class ManageUserController extends Controller {

    private $userDao;

    public function __construct() {
        $this->userDao = new UserDao();
    }
    
    public function manageUser() {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $result = array_map($this->formatHTMLUser, $this->userDao->getUsers());

        return new View("manageUser", ["users" => $result]);
    }

    private function formatHTMLUser($user) {
        return
        "<tr>
            <td>" . $user->getId() . "</td>
            <td>" . $user->getPseudo() . "</td>
            <td>" . $user->getLastName() . "</td>
            <td>" . $user->getFirstName() . "</td>
            <td>" . $user->getEmail() . "</td>
            <td>" . $user->getPhoneNumber() . "</td>
            <td>" . $user->getCity() . "</td>
            <td>" . $user->getRole() . "</td>
        <tr>";
    }
}