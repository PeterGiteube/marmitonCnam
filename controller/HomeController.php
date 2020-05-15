<?php

use Framework\Http\Response;

class HomeController {

    public function home() {
        return Response::view('home');
    }
}