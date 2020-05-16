<?php

namespace Framework\Http;

use Framework\Collection\Dictionary;

interface Request {

    public function routeArguments() : Dictionary;
    public function request() : Dictionary;
    public function query() : Dictionary;
    public function body() : string;
    public function url() : string;
}