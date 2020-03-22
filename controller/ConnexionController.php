<?php

use Framework\Configuration;
use Framework\Redirection\RedirectTrait;
use Framework\View;

class ConnexionController {

    use RedirectTrait;

    private $userModel;
    private $error;
    private $indexLocation;
    
    public function __construct() {
        $this->userModel = new Utilisateur();
        $this->error = "";
        $this->indexLocation = Configuration::get("index");
    }

    public function connexion(array $request) {
        $this->denyAccessUnless('NOT_LOGGED');

        $post = $request['POST'];

        if(!empty($post)) {
            $userName = $post['username'];
            $password = $post['password'];

            if($userName != null && $password != null) {
                if(strlen($userName) > 0 && strlen($password) > 0) {
                    $this->proceedCredentials($userName, $password);
                } else {
                    $this->setConnexionError("Les champs ne peuvent pas être vides");
                }
            }
        }

        $view = new View("connexion");
        $view->render(["error" => $this->handleError()]);
    }

    public function logout() {
        $this->denyAccessUnless('LOGGED');

        $_SESSION = [];
        session_destroy();
        $this->redirect($this->indexLocation);
    }

    private function proceedCredentials(string $userName, string $password) {
        $result = $this->getCredentials($userName, $password);

        if($result) {
            $_SESSION['id'] = $result['id_utilisateur'];
            $_SESSION['username'] = $result['pseudo'];
            $_SESSION['admin_role'] = false;

            if($this->userModel->isUserAdminByUserId($result['id_utilisateur'])) {
                $_SESSION['admin_role'] = true;
            }

            $this->redirect($this->indexLocation);
        } else {
            $this->setConnexionError("Utilisateur et/ou mot de passe incorrect(s)");
        }
    }

    private function getCredentials($userName, $password) { 
        return $this->userModel->getUserByCredentials($userName,$password);
    }

    private function denyAccessUnless(string $state) {
        if($state == 'NOT_LOGGED') {
            if(isset($_SESSION['id'])) {
                $this->redirect($this->indexLocation);
            }
        } else if ($state == 'LOGGED') {
            if(!isset($_SESSION['id'])) {
                $this->redirect($this->indexLocation);
            }
        }
    }


    private function setConnexionError(string $message) {
        $this->error = $message;
    }

    private function handleError() {
        $error = $this->error;
        $this->error = "";

        return $error;
    }
}