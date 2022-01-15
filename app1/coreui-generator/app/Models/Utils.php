<?php

namespace App\Models;

/**
 * Class Utils
 * @package App\Models
 */
class Utils
{
    public static function currency($value)
    {
        return ((int)($value * 100))/100;
    }

    public static function shares($value)
    {
        return ((int)($value * 10000))/10000;
    }

    public static function percent($value)
    {
        return ((int)($value * 100))/100;
    }
    
}
