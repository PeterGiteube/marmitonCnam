<?php

use Framework\Configuration;
use Framework\Controller\Controller;
use Framework\Http\Response;
use Framework\Http\Request;

class ProfileController extends Controller
{
    private $userDao;

    public function __construct() {
        $this->userDao = new UserDao();
    }

    public function profile(Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $user = $this->getUser();

        return Response::view("profile", [
            'errorMessage' => $this->flash('error'),
            'successMessage' => $this->flash('success'),
            'user' => $user
        ]);
    }

    public function updateInfo(Request $request) {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $user = $this->getUser();
        
        $post = $request->request();

        if($this->validForm($post)) {
            $pseudo = $post->get('pseudo');
            $firstName = $post->get('first-name');
            $lastName = $post->get('last-name');
            $phone = $post->get('phone');
            $city = $post->get('city');

            $this->userDao->updateUserInfosById(
                $user->getId(),
                $pseudo,
                $lastName, 
                $firstName, 
                $user->getEmail(),
                $phone,
                $city,
                $user->getRole()
            );

            $this->refreshUser($user->getId());
            $this->addFlash('success', 'Vos informations ont bien été mises à jour.');
        } else {
            $this->addFlash('error', 'Les champs ne sont pas valides.');
        }

        $this->redirect(Configuration::get('index') . '/profile');
    }

    public function updateSecurity(Request $request) {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $user = $this->getUser();
        
        $post = $request->request();

        if($this->validForm($post)) {
            $actualPassword = $post->get('password');
            $newPassword = $post->get('new-password');
            $confirmation = $post->get('confirm-new-password');

            if($actualPassword == $user->getPassword()) {

                $userId = $user->getId();

                if($newPassword == $confirmation) {
                    $this->userDao->updateUserCredentialsById(
                        $userId,
                        $user->getEmail(),
                        $newPassword
                    );

                    $this->refreshUser($userId);
                    $this->addFlash('success', 'Le mot de passe a bien été enregistré.');

                } else {
                    $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                }

            } else {
                $this->addFlash('error', 'Le mot de passe actuel est incorrect.');
            }           
        } else {
            $this->addFlash('error', 'Les champs ne sont pas valides.');
        }

        $this->redirect(Configuration::get('index') . '/profile');
    }

    private function refreshUser($id) {
        $user = $this->userDao->getUserById($id);

        $_SESSION['user'] = $user;
    }

    private function getUser() {
        return $_SESSION['user'];
    }

    private function validForm($post) {
        if($post->count() <= 0) {
            return false;
        }

        foreach($post as $data) {
            if (empty($data))
                return false;
        }

        return true;
    }
}