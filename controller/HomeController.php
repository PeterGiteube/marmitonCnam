<?php

use Framework\View;

class HomeController {


    public function home($request) {
        $view = new View("home");

        $view->render([]);
    }
}