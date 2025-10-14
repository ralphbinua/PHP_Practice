<?php

class StringUtility {

    public static function shout($string) {
        return strtoupper($string) . '!';
    }

    public static function whisper($string) {
        return strtolower($string) . '.';
    }

    public static function repeat($string, $times = 2) {
        return str_repeat($string, $times);
    }
}

$utility = new StringUtility();

echo $utility->shout('Hello World') . "\n";
echo $utility->whisper('Hello World') . "\n";
echo $utility->repeat('Hello World ') . "\n";
echo $utility->repeat('Hello World ', 5) . "\n";

?>