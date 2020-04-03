<?php

use Framework\View;

class HomeController {

    public function home() {
        return new View("home", []);
    }
}