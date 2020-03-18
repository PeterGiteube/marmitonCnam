<?php

session_start();

class HomeController {

    public function home() {
        $view = new View("home");
        $data = [];

        if(isset($_SESSION['username'])) {
            $userName = $_SESSION['username'];
            $data = ["userName" => $userName];
        }

        $view->render($data);
    }
}