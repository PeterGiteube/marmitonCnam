<?php

use Framework\Configuration;
use Framework\Controller\Controller;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\View;

class ConnexionController extends Controller {

    private $userDAO;
    private $error;
    private $indexLocation;
    
    public function __construct() {
        $this->userDAO = new UserDao();
        $this->error = "";
        $this->indexLocation = Configuration::get("index");
    }

    public function login(Request $request) {
        $this->denyAccessUnlessGranted('ANONYMOUS');

        $post = $request->request();

        if($post->count() > 0) {
            $userName = $post->get('username');
            $password = $post->get('password');

            if($userName != null && $password != null) {
                if(strlen($userName) > 0 && strlen($password) > 0) {
                    $this->proceedCredentials($userName, $password);
                } else {
                    $this->setConnexionError("Les champs ne peuvent pas être vides");
                }
            }
        }


        return Response::view("connexion", ["error" => $this->handleError()]);
    }

    public function logout() {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $_SESSION = [];
        session_destroy();
        $this->redirect($this->indexLocation);
    }

    private function proceedCredentials(string $userName, string $password) {
        $user = $this->userDAO->getUserByCredentials($userName,$password);

        if($user) {
            $_SESSION['user'] = $user;
            $this->redirect($this->indexLocation);
        } else {
            $this->setConnexionError("Utilisateur et/ou mot de passe incorrect(s)");
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