<?php

use Framework\Redirection\RedirectTrait;
use Framework\Configuration;
use Framework\UserRoleInterface;

abstract class Controller {

    use RedirectTrait;

    private static $defaultRedirectionLocation;

    const roles = [
        'USER' => 'ROLE_USER',
        'ADMIN' => 'ROLE_ADMIN'
    ];

    const ANONYMOUS = 'ANONYMOUS';

    protected function denyAccessUnlessGranted(string $state) {
        if(!isset($_SESSION['user']))
            $this->redirect(self::getRedirectionLocation());

        $user = self::getUser();
        $role = $user->getAccessRole();

        if($state == self::roles['ADMIN']) {
            if($role != $state) {
                $this->redirect(self::getRedirectionLocation());
            }
        }
    }

    protected function allowAccessOnlyFor(string $state) {
        if($state == self::ANONYMOUS) {
            if(isset($_SESSION['user'])) {
                $this->redirect(self::getRedirectionLocation());
            }
        }

        if(isset($_SESSION['user'])) {
            $user = self::getUser();
            $role = $user->getAccessRole();

            if($state != $role) {
                $this->redirect(self::getRedirectionLocation());
            }
        }
    }

    private static function getRedirectionLocation() {
        if(self::$defaultRedirectionLocation == null) {
            self::$defaultRedirectionLocation = Configuration::get('index');
        }

        return self::$defaultRedirectionLocation;
    }

    private static function getUser() : UserRoleInterface {
        return $_SESSION['user'];
    }
}
