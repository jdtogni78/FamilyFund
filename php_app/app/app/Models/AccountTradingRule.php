<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AccountTradingRule
 *
 * @property $id
 * @property $account_id
 * @property $trading_rule_id
 * @property $created
 * @property $updated
 *
 * @property Account $account
 * @property TradingRule $tradingRule
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AccountTradingRule extends Model
{
    
    static $rules = [
		'account_id' => 'required',
		'trading_rule_id' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['account_id','trading_rule_id','created','updated'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        return $this->hasOne('App\Models\Account', 'id', 'account_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tradingRule()
    {
        return $this->hasOne('App\Models\TradingRule', 'id', 'trading_rule_id');
    }
    

}
