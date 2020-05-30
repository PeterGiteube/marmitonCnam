<?php

use Framework\Controller\Controller;
use Framework\Http\Response;
use Framework\Http\Request;

class RegistrationController extends Controller {

    public function registration(Request $request) {
        $this->denyAccessUnlessGranted('ANONYMOUS');

        $post = $request->request();

        if($post->count() > 0) {
                     

        }

        return Response::view('registration');
    }
}