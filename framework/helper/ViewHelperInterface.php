<?php

namespace Framework\Helper;

use Closure;

interface ViewHelperInterface {

    /**
     * Name of the helper function to use as a method of the View class.
     *
     * @return string
     */
    function getName() : string;

    /**
     * Closure wrapper of the helper function.
     *
     * @return Closure
     */
    function getHelper() : Closure;
}
