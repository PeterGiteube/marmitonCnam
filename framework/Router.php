<?php

class Router {

    private $connexionController;
    private $homeController;

    public function __construct()
    {
        $this->connexionController = new ConnexionController();
        $this->homeController = new HomeController();
    }

    public function request()
    {
        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();

        try {
            if(empty($_SESSION)) {
                if(isset($_GET['action'])) {
                    if($_GET['action'] == "connexion") {
                        $this->connexionController->connexion();
                    } 
                } else {
                    $this->homeController->home();
                }
            } else {
                $this->homeController->home();
            }
        } catch (Exception $ex) {
            $this->error($ex->getMessage());
        }
    }

    private function error($msg) {
        echo $msg;
    }
}