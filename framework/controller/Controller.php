<?php

namespace Framework\Controller;

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

    protected function hasRole(string $role) {
        return $this->roleChecker->hasRole($role);
    }

    protected function denyAccessUnlessGranted(string $role) {
        if(!$this->hasRole($role)) {
            $this->redirect(self::getRedirectionLocation());
        }
    }

    protected function addFlash(string $type, string $message) {
        $this->createFlashsBagIfNotExists();

        $flashs = $_SESSION['flash'];

        $flashs->set($type, $message);
    }

    protected function flash(string $type) {
        $STRING_EMPTY = "";

        if(!isset($_SESSION['flash']))  {
            return $STRING_EMPTY;
        }      

        $flashs = $_SESSION['flash'];

        if($flashs->has($type)) {
            $message = $flashs->get($type);
            $flashs->remove($type);
            return $message;           
        }

        return $STRING_EMPTY;
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
