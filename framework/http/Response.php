<?php

namespace Framework\Http;

use Framework\Dictionary;
use Framework\Helper\ViewHelperContainer;
use Framework\View;
use http\Exception\InvalidArgumentException;

class Response {

    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_SERVER_ERROR = 500;

    protected $content;
    protected $charset;
    protected $statusCode;
    protected $reasonPhrase;

    /**
     * @var Dictionary
     */
    protected $headers;

    public function __construct($content = "", $headers = [], $statusCode = 200)
    {
        $this->headers = new Dictionary($headers);
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    public static function json($data = []) {
        $encodedJson = json_encode($data);

        return new Response($encodedJson, ['Content-type' => 'application/json']);
    }

    public static function view($htmlFileName, $data = []) {
        $view = new View($htmlFileName, $data);
        $view->setHelpers([
            ViewHelperContainer::get('role_checker'),
            ViewHelperContainer::get('route_path')
        ]);

        $content = $view->render();

        return new Response($content, ['Content-type' => 'text/html']);
    }

    public function headers() : Dictionary
    {
        return $this->headers;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode(int $statusCode)
    {
        if($statusCode < 100 || $statusCode >= 600 ) {
            throw new InvalidArgumentException("Status code %s is not a valid code", $statusCode);
        }

        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param $charset
     * @return $this
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReasonPhrase()
    {
        return $this->reasonPhrase;
    }

    /**
     * @param string $reasonPhrase
     */
    public function setReasonPhrase($reasonPhrase)
    {
        $this->reasonPhrase = $reasonPhrase;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    public function send()
    {
        if(null === $this->charset || false === $this->charset) {
            $this->charset = 'utf-8';
        }

        if(!$this->headers->has('Content-type')) {
            $this->headers->set('Content-type', 'text/html; charset=' . $this->charset);
        } else {
            $charsetPos = stripos($this->headers->get('Content-type'), 'charset');

            if($charsetPos === false) {
                $contentTypeContent = $this->headers->get('Content-type');
                $this->headers->set('Content-type', $contentTypeContent . '; charset=' . $this->charset);
            }
        }

        $this->sendHeaders();
        $this->sendContent();
    }

    private function sendHeaders()
    {
        if(headers_sent()) {
            return;
        }

        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value, false, $this->getStatusCode());
        }

        $headerContent = sprintf('HTTP/1.1 %s %s', $this->getStatusCode(), $this->getReasonPhrase());
        header($headerContent, true, $this->getStatusCode());
    }

    private function sendContent()
    {
        echo $this->content;
    }
}
