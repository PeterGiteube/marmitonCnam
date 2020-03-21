<?php

use Framework\Configuration;
use Framework\Redirection\RedirectTrait;
use Framework\View;

class ConnexionController {

    use RedirectTrait;

    private $userModel;
    private $error;
    
    public function __construct() {
        $this->userModel = new Utilisateur();
        $this->error = ""; 
    }

    public function connexion($request) {
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
        $_SESSION = [];
        session_destroy();
        $this->redirect(Configuration::get('index'));
    }

    private function proceedCredentials($userName, $password) {
        $result = $this->getCredentials($userName, $password);

        if($this->credentialsValid($result)) {
            $_SESSION['id'] = $result['id_utilisateur'];
            $_SESSION['username'] = $result['pseudo'];
            $_SESSION['admin_role'] = false;

            if($this->userModel->isUserAdminByUserId($result['id_utilisateur'])) {
                $_SESSION['admin_role'] = true;
            }

            $this->redirect(Configuration::get('index'));
        } else {
            $this->setConnexionError("Utilisateur et/ou mot de passe incorrect(s)");
        }
    }

    private function getCredentials($userName, $password) { 
        $userInfos = $this->userModel->getUserByCredentials($userName,$password);
        return $userInfos;
    }    

    private function credentialsValid($credentials) {
        if($credentials) {
            return true;
        }

        return false;
    }

    private function setConnexionError($message) {
        $this->error = $message;
    }

    private function handleError() {
        $error = $this->error;
        $this->error = "";

        return $error;
    }
}