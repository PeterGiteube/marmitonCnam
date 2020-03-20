<?php

class HomeController {

    public function home() {
        $view = new View("home");
        $userName = "Visiteur";

        if(isset($_SESSION['username'])) {
            $userName = $_SESSION['username'];
        }

        $data = ["userName" => $userName];
        $view->render($data);
    }
}