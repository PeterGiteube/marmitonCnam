<?php

namespace Framework;

use Framework\Collection\Dictionary;
use Framework\RoleChecker;
use Framework\Redirection\RedirectTrait;
use Framework\Configuration;

abstract class Controller {

    use RedirectTrait;

    private static $defaultRedirectionLocation;

    /**
     * @var RoleChecker
     */
    private $roleChecker;

    public function setRoleChecker(RoleChecker $roleChecker) {
        $this->roleChecker = $roleChecker;
    }

    protected function denyAccessUnlessGranted(string $role) {
        if(!$this->roleChecker->hasRole($role)) {
            $this->redirect(self::getRedirectionLocation());
        }
    }

    private function createFlashsBagIfNotExists() {
        if(!isset($_SESSION['flash'])) {
            $_SESSION['flash'] = new Dictionary([]);
        }
    }

    private static function getRedirectionLocation() {
        if(self::$defaultRedirectionLocation == null) {
            self::$defaultRedirectionLocation = Configuration::get('index');
        }

        return self::$defaultRedirectionLocation;
    }
}
