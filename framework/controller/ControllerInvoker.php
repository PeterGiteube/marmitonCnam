<?php

namespace Framework\Controller;

use Framework\View;
use ReflectionClass;
use ReflectionException;

class ControllerInvoker {

    private $controller;
    private $roleChecker;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function prepareRoleCheckerInjection($roleChecker) {
        $this->roleChecker = $roleChecker;
    }

    public function invoke($request) : View {
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