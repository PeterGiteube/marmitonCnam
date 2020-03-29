<?php

use Framework\Redirection\RedirectTrait;
use Framework\Configuration;

abstract class Controller {

    use RedirectTrait;

    private static $defaultRedirectionLocation;

    protected function denyAccessUnlessGranted(string $state) {
        
        if ($state == 'ROLE_USER') {
            if(!isset($_SESSION['user'])) {
                $this->redirect(self::getRedirectionLocation());
            }
        } else if( $state == 'ROLE_ADMIN') {
            if(!isset($_SESSION['user'])) {
                $this->redirect(self::getRedirectionLocation());
            } else {
                $user = $_SESSION['user'];
                $role = $user->getRole();

                if ($role < 2 ) $this->redirect(self::getRedirectionLocation());
            }
        }
    }

    protected function allowAccessOnlyFor(string $state) {
        if($state == 'ANONYMOUS') {
            if(isset($_SESSION['user'])) {
                $this->redirect(self::getRedirectionLocation());
            }
        } else if ($state == 'ROLE_USER') {
            if(!isset($_SESSION['user'])) {
                $this->redirect(self::getRedirectionLocation());
            }
        } else if ($state == 'ROLE_ADMIN') {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }
    }

    private static function getRedirectionLocation() {
        if(self::$defaultRedirectionLocation == null) {
            self::$defaultRedirectionLocation = Configuration::get('index');
        }

        return self::$defaultRedirectionLocation;
    }
}
