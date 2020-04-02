<?php

use Framework\RoleChecker;
use Framework\Redirection\RedirectTrait;
use Framework\Configuration;

abstract class Controller {

    use RedirectTrait;

    private static $defaultRedirectionLocation;

    /**
     * @var RoleChecker
     */
    private $authorizationChecker;

    public function setAuthorizationChecker(RoleChecker $authorizationChecker) {
        $this->authorizationChecker = $authorizationChecker;
    }

    protected function denyAccessUnlessGranted(string $role) {
        if(!$this->authorizationChecker->hasRole($role)) {
            $this->redirect(self::getRedirectionLocation());
        }
    }

    private static function getRedirectionLocation() {
        if(self::$defaultRedirectionLocation == null) {
            self::$defaultRedirectionLocation = Configuration::get('index');
        }

        return self::$defaultRedirectionLocation;
    }
}
