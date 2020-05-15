<?php

use Framework\Controller\Controller;
use Framework\Http\Response;

class RegistrationController extends Controller {

    public function registration() {
        $this->denyAccessUnlessGranted('ANONYMOUS');

        return Response::view('registration');
    }
}