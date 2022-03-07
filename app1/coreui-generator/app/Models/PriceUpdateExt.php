<?php

namespace App\Models;

/**
 * Class PriceUpdateExt
 * @package App\Models
 * @version March 5, 2022, 8:26 pm UTC
 */
class PriceUpdateExt extends PriceUpdate
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'source' => 'required|string|max:30',
        'timestamp' => 'required',
        'symbols' => 'required|array',
        'symbols.*.name' => 'required|string|not_in:CASH',
        'symbols.*.price' => 'required|numeric',
        'symbols.*.type' => 'string|not_in:CSH',
    ];
}
