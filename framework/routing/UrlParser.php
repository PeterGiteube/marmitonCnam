<?php

namespace Framework\Routing;

class UrlParser {

    private static $URL_SEGMENT_IDENTIFIER = '/';
    private static $EMPTY_TOKEN = '';

    public function parse($url) : array {
        $tokens = array_slice(explode(self::$URL_SEGMENT_IDENTIFIER, $url), 1);

        $endPos = count($tokens) - 1;
        $endToken = $tokens[$endPos];


        if(strcmp($endToken, self::$EMPTY_TOKEN) == 0) {
            array_splice($tokens, $endPos);
        }

        return $tokens;
    }
}