<?php

use Framework\Controller\Controller;
use Framework\Http\Response;

class AdminController extends Controller {

    public function admin() {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        return Response::view('admin');
    }
}