<?php

use Framework\Configuration;
use Framework\Controller\Controller;
use Framework\Http\Response;
use Framework\View;

class ManageUserController extends Controller
{

    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function manage()
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $users = $this->userDao->getUsers();
        $result = array_map($this->formatHTMLUser(), $users);

        return Response::view("manageUser", ["users" => $result]);
    }

    private function formatHTMLUser()
    {
        return function ($user) {
            return "
            <tr id='userRow" . $user->getId() . "'>
                <td>" . $user->getId() . "</td>
                <td>" . $user->getPseudo() . "</td>
                <td>" . $user->getLastName() . "</td>
                <td>" . $user->getFirstName() . "</td>
                <td>" . $user->getEmail() . "</td>
                <td>" . $user->getPhoneNumber() . "</td>
                <td>" . $user->getCity() . "</td>
                <td>" . $user->getRole() . "</td>
                <td><a class='btn btn-secondary' href='".Configuration::get('index')."/admin/user/".$user->getId()."/edit' role='button'>Edit</a> <button data-id='".$user->getId()."'id='delete-user' class='btn btn-danger' type='button' data-toggle='modal' data-target='#delete-user-modal'>Supprimer</button></td>
            </tr>
            ";
        };
    }
}