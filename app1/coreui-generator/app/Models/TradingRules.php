<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TradingRules
 * @package App\Models
 * @version January 4, 2022, 3:07 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $accountTradingRules
 * @property string $name
 * @property number $max_sale_increase_pcnt
 * @property number $min_fund_performance_pcnt
 */
class TradingRules extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'trading_rules';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'max_sale_increase_pcnt',
        'min_fund_performance_pcnt'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'max_sale_increase_pcnt' => 'decimal:2',
        'min_fund_performance_pcnt' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:30',
        'max_sale_increase_pcnt' => 'nullable|numeric',
        'min_fund_performance_pcnt' => 'nullable|numeric',
        'created_at' => 'required',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function accountTradingRules()
    {
        return $this->hasMany(\App\Models\AccountTradingRule::class, 'trading_rule_id');
    }
}