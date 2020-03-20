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
        $uri = $_SERVER['REQUEST_URI'];

        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();

        try {

            switch($uri) {
                case '/marmitonCnam/' :
                    $this->homeController->home();
                    break;
                case '/marmitonCnam/login' :
                    if(empty($_SESSION)) 
                        $this->connexionController->connexion();
                    else
                        $this->homeController->home(); 
                    break;
                case '/marmitonCnam/logout':
                    $this->connexionController->logout();
                    break;
                default:
                    http_response_code(404);
            }

        } catch (Exception $ex) {
            $this->error($ex->getMessage());
        }
    }

    private function error($msg) {
        echo $msg;
    }
}