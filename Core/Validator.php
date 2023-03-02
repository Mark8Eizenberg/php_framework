<?php

namespace Core;

class Validator{

    public static function string($data, $min = 1, $max = INF): bool
    {
        $text = filter_var($data);
        
        if($text){
            $text = trim($text);
        } else {
            return false;
        }

        return strlen($text) >= $min && strlen($text) <= $max;
    }

    public static function email($data)
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }
}