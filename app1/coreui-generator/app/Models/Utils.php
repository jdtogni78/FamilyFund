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
        return round($value, 2);
    }

    public static function shares($value)
    {
        return floor($value * 10000)/10000;
    }
    public static function assetShares($value)
    {
        return floor($value * 100000000)/100000000;
    }

    public static function percent($value)
    {
        return round($value,2);
    }
    
}
