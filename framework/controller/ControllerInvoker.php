<?php

namespace Framework\Controller;

use Framework\Http\Response;
use Framework\View;
use ReflectionClass;
use ReflectionException;

class ControllerInvoker {

    private $controller;
    private $roleChecker;

    public function setRoleChecker($roleChecker) {
        $this->roleChecker = $roleChecker;
    }

    public function prepare($controller) {
        $this->controller = $controller;
    }

    public function invoke($request) : Response {
        $controllerInstance = $this->controller['class_instance'];
        $controllerMethodName = $this->controller['controller'];

        $this->injectRoleChecker($controllerInstance);

        try {
            $class = new ReflectionClass(get_class($controllerInstance));
            $reflectionMethod = $class->getMethod($controllerMethodName);

            return $reflectionMethod->invoke($controllerInstance, $request);

        } catch (ReflectionException $ex) {
            throw $ex;
        }
    }

    private function injectRoleChecker($controllerInstance) {
        if (is_subclass_of($controllerInstance, Controller::class)) {
            $controllerInstance->setRoleChecker($this->roleChecker);
        }
    }
}