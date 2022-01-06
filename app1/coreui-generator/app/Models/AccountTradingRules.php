<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class AccountTradingRules
 * @package App\Models
 * @version January 4, 2022, 3:06 pm UTC
 *
 * @property \App\Models\Account $account
 * @property \App\Models\TradingRule $tradingRule
 * @property integer $account_id
 * @property integer $trading_rule_id
 */
class AccountTradingRules extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'account_trading_rules';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'account_id',
        'trading_rule_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'account_id' => 'integer',
        'trading_rule_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'account_id' => 'required|integer',
        'trading_rule_id' => 'required|integer',
        'created_at' => 'required',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tradingRule()
    {
        return $this->belongsTo(\App\Models\TradingRule::class, 'trading_rule_id');
    }
}
