<?php

use Framework\Configuration;
use Framework\Controller\Controller;
use Framework\Http\Response;
use Framework\Http\Request;

class RegistrationController extends Controller {

    private $userDao;
    private $error;

    public function __construct() {
        $this->userDao = new UserDao();
        $this->error = "";
    }

    public function registration(Request $request) {
        $this->denyAccessUnlessGranted('ANONYMOUS');

        $post = $request->request();

        if($this->validForm($post)) {
            $email = $post->get('email');

            if(!$this->userDao->existsByUniqueEmail($email)) {
                $password = $post->get('password');
                $confirm = $post->get('confirm-password');

                if($password == $confirm) {
                    $role = "USER";
                    $phone = "";
            
                    try {
                        $token = bin2hex(openssl_random_pseudo_bytes(16));
                        $this->userDao->insertUnconfirmedUser(
                            $post->get('pseudo'), 
                            $password, 
                            $post->get('last-name'), 
                            $post->get('first-name'), 
                            $email,
                            $phone, 
                            $post->get('city'), 
                            $role,
                            $token
                        ); 

                        $userId = $this->userDao->getLastId();

                        $url = $this->generateConfirmationURL($userId, $token);
                        $this->sendEmail($email, $url);

                        $this->addFlash('success', 'Un email de confirmation vous a été envoyé.');

                        $this->redirect(Configuration::get('index') . "/login");                   
                    }
                    catch(Exception $ex) {
                        $this->error = "Impossible de proceder à l'inscription";
                    }
                } else {
                    $this->error = "Les mots de passes ne correspondent pas";
                }             
            } else {
                $this->error = "Cette addresse email est déjà enregistrée";
            }
        }

        return Response::view('registration', ['error' => $this->error]);
    }

    public function confirm(Request $request) {
        $this->denyAccessUnlessGranted("ANONYMOUS");

        $query = $request->query();

        if($query->has('id') && $query->has('token')) {
            $userId = $query->get('id');
            $validationToken =  $query->get('token');

            if($this->userDao->isConfirmationValid($userId, $validationToken)) {
                $this->userDao->deleteUnconfirmedUser($userId);
                $this->addFlash('success', 'Votre compte a bien été validé.');
                $this->redirect(Configuration::get('index') . '/login');
            }
        }       

        $this->redirect(Configuration::get('index') . '/');
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

    private function sendEmail($to, $confirmationUrl) 
    {
        $from = "marmitoncnam@alwaysdata.net";
        $header = "From: ". $from;
        $subject = "Confirmation de votre email pour votre inscription";
        $message = "Afin de valider l'inscription de votre compte sur notre site, merci de cliquer sur " . $confirmationUrl;

        mail($to, $subject, $message, $header);
    }

    private function generateConfirmationURL($id, $token) 
    {
        return $_SERVER['SERVER_NAME'] . Configuration::get('index') . "/registration/confirm?id=" . $id . "&token=" . $token;
    }
 
}