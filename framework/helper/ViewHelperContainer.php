<?php

namespace Framework\Helper;

class ViewHelperContainer {

    private static $helpers = [];

    public static function append($helpers) {
        self::$helpers = $helpers;
    }

    public static function get($name) {
        return self::$helpers[$name];
    }

}