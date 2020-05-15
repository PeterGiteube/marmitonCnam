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
        $type = $this->controller['_type'];
        $controller =  $this->controller['_controller'];

        if($type == 'closure') {
            return $this->invokeClosure($controller, $request);
        }

        if($type == 'method') {
            return $this->invokeMethod($controller, $request);
        }

    }

    private function invokeClosure($controller, $request) {
        return $controller($request);
    }

    private function invokeMethod($controller, $request) {
        $className = $controller['_class_name'];
        $methodName = $controller['_method_name'];

        try {
            $reflectionClass = new ReflectionClass($className);
            $instance = $reflectionClass->newInstance();
            $reflectionMethod = $reflectionClass->getMethod($methodName);

            $this->injectRoleChecker($instance);

            return $reflectionMethod->invoke($instance, $request);

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