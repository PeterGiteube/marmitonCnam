<?php

namespace Framework\Routing;

class UrlParser {

    private static $URL_SEGMENT_IDENTIFIER = '/';
    private static $EMPTY_TOKEN = '';
    private static $GET_REQUEST_TOKEN = '?';

    public function parse($url) : array {
        $tokens = array_slice(explode(self::$URL_SEGMENT_IDENTIFIER, $url), 1);

        $endPos = count($tokens) - 1;
        $endToken = $tokens[$endPos];

        if(stripos($endToken, self::$GET_REQUEST_TOKEN) !== false) {
            array_splice($tokens, $endPos);
        }

        if(strcmp($endToken, self::$EMPTY_TOKEN) == 0) {
            array_splice($tokens, $endPos);
        } else {
            $pos = stripos($endToken, self::$GET_REQUEST_TOKEN);
            if($pos == 1) {
                array_splice($tokens, $endPos);
            } else if ( $pos > 1 ) {
                $token = explode(self::$GET_REQUEST_TOKEN, $endToken)[0];
                $tokens[$endPos] = $token;
            }
        }

        return $tokens;
    }
}