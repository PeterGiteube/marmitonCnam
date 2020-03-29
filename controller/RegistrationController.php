<?php

use Framework\View;

class RegistrationController extends Controller {

    public function registration() {
        $this->allowAccessOnlyFor('ANONYMOUS');

        $view = new View('registration');
        $view->render([]);
    }
}