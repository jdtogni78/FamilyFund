<?php

namespace App\Models;

/**
 * Class PositionUpdateExt
 * @package App\Models
 * @version March 5, 2022, 8:26 pm UTC
 */
class PositionUpdateExt extends PositionUpdate
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'source' => 'required|string|max:30|exists:portfolios,source',
        'timestamp' => 'required',
        'symbols' => 'required|array',
        'symbols.*.name' => 'required|string',
        'symbols.*.position' => 'required|numeric',
        'symbols.*.type' => 'string',
    ];
}
