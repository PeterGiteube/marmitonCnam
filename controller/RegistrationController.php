<?php

use Framework\Controller\Controller;
use Framework\View;

class RegistrationController extends Controller {

    public function registration() {
        $this->denyAccessUnlessGranted('ANONYMOUS');

        return new View('registration', []);
    }
}