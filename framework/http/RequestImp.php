<?php

namespace Framework\Http;

use Framework\Dictionary;

class RequestImp implements Request {

    private $method;

    /**
     * POST body parameters
     *
     * @var Dictionary
     */
    private $request;

    /**
     * GET string parameters
     *
     * @var Dictionary
     */
    private $query;

    /**
     * Route arguments for dynamic route parameters. Empty if the route is static.
     *
     * @var Dictionary
     */
    private $routeArguments;

    private $body;

    private $url;

    public function __construct(array $request = [], array $query = [], string $method = 'GET', string $body = "", string $url = "") {
        $this->request = new Dictionary($request);
        $this->query = new Dictionary($query);
        $this->method = $method;
        $this->body = $body;
        $this->url = $url;
    }

    public static function createFromGlobals() {
        $body = file_get_contents('php://input');
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];

        return new RequestImp($_POST, $_GET, $method, $body, $url);
    }

    public function setRouteArguments(Dictionary $arguments) {
        $this->routeArguments = $arguments;
    }

    public function routeArguments() : Dictionary {
        return $this->routeArguments;
    }

    public function request() : Dictionary {
        return $this->request;
    }

    public function query() : Dictionary {
        return $this->query;
    }

    public function body() : string {
        return $this->body;
    }

    public function url() : string {
        return $this->url;
    }

    public function method() : string {
        return $this->method;
    }
}
