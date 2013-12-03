<?php

namespace lib;

class Json {
//put your code here
    public static function read($path) {
        if (file_exists($path)) {
            $string = file_get_contents($path);
            $json = json_decode($string, true);
            return $json;
        } else {
            return 0;
        }
    }

    /*
    public static function write($name, $value) {
        self::$confArray[$name] = $value;
    }
     */
}