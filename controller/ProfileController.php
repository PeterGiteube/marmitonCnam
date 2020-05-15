<?php

use Framework\Controller\Controller;
use Framework\Http\Response;

class ProfileController extends Controller
{

    public function profile()
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $user = $_SESSION['user'];

        return Response::view("profile", ['user' => $user]);
    }
}