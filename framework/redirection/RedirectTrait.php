<?php

trait RedirectTrait {
    
    public function redirect($location) {
        header("Location: $location.php");
        die();
    }
}