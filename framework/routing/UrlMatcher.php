<?php

namespace Framework\Routing;

use Framework\Collection\Dictionary;

class UrlMatcher {

    /**
     * @var UrlParser
     */
    private $parser;

    private $urlPattern;
    private $urlSegments;

    private static $DYNAMIC_IDENTIFIER = ':';

    public function __construct($urlPattern) {
        $this->parser = new UrlParser();
        $this->urlPattern = $urlPattern;
        $this->urlSegments = $this->parser->parse($urlPattern);
    }

    public function match($queryUrl) {
        $querySegments = $this->parser->parse($queryUrl);

        if($this->urlsLengthNotEquals($querySegments))
            return false;

        if(!$this->isUrlPatternDynamic())
            return array_values($querySegments) == array_values($this->urlSegments);

        return $this->isUrlMatchWithDynamicPattern($querySegments);
    }

    public function extract($queryUrl) {
        $arguments = new Dictionary([]);

        $querySegments = $this->parser->parse($queryUrl);

        if($this->urlsLengthNotEquals($querySegments)) {
            $message = "query url not matching";
            throw new \Exception($message);
        }

        if($this->isUrlPatternDynamic()) {
            $zipped = self::array_zip($querySegments, $this->urlSegments);
            array_walk($zipped, $this->fillArgumentsBag($arguments));
        }

        return $arguments;
    }

    private function fillArgumentsBag($arguments) : \Closure {
        return function($element) use ($arguments) {
            $querySegment = $element[0];
            $segmentPattern = $element[1];

            $pos = strpos($segmentPattern, self::$DYNAMIC_IDENTIFIER);

            if($pos !== false) {
                $parameter = explode(self::$DYNAMIC_IDENTIFIER, $segmentPattern)[1];
                $arguments->set($parameter , $querySegment);
            }
        };
    }

    private function isUrlMatchWithDynamicPattern($querySegments) {
        $zipped = array_map(NULL, $querySegments, $this->urlSegments);

        $result = array_map(function($element) {
            $querySegment = $element[0];
            $segmentPattern = $element[1];

            $pos = strpos($segmentPattern, self::$DYNAMIC_IDENTIFIER);

            if($pos === false) {
                return $querySegment == $segmentPattern;
            }

            return true;

        }, $zipped);

        sort($result);

        return $result[0];
    }

    private function urlsLengthNotEquals($querySegments) {
        return count($querySegments) != count($this->urlSegments);
    }

    private function isUrlPatternDynamic() {
        return strpos($this->urlPattern, self::$DYNAMIC_IDENTIFIER) !== false;
    }

    private static function array_zip($current, $other) {
        return array_map(NULL, $current, $other);
    }
}