<?php

use Framework\View;

class HomeController {

    public function home() {
        $view = new View("home");

        $view->render([]);
    }
}