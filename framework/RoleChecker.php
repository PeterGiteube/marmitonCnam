<?php

namespace Framework;

class RoleChecker {

    const roles = [
        'USER' => 'ROLE_USER',
        'ADMIN' => 'ROLE_ADMIN'
    ];

    const ANONYMOUS = 'ANONYMOUS';

    public function hasRole($role) {
        if(!isset($_SESSION['user'])) {
            if($role == self::ANONYMOUS) {
                return true;
            }

            return false;
        }
        
        $user = self::getUser();
        $userRole = $user->getAccessRole();

        if($role == self::roles['USER']) {
            return true;
        }

        if($role == self::roles['ADMIN']) {
            if($userRole == $role) {
                return true;
            }
        }   

        return false;
    }

    private static function getUser() : UserRoleInterface {
        return $_SESSION['user'];
    }
}