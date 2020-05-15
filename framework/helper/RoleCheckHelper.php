<?php

namespace Framework\Helper;

use Closure;

class RoleCheckHelper implements ViewHelperInterface {

    private $roleChecker;

    public function __construct($roleChecker)
    {
        $this->roleChecker = $roleChecker;
    }

    function getName() : string
    {
        return "hasRole";
    }

    function getHelper() : Closure
    {
        return function($role) {
            return $this->roleChecker->hasRole($role);
        };
    }
}
