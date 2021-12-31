<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TradingRule
 *
 * @property $id
 * @property $name
 * @property $max_sale_increase_pcnt
 * @property $min_fund_performance_pcnt
 * @property $created
 * @property $updated
 *
 * @property AccountTradingRule[] $accountTradingRules
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TradingRule extends Model
{
    
    static $rules = [
		'name' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','max_sale_increase_pcnt','min_fund_performance_pcnt','created','updated'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountTradingRules()
    {
        return $this->hasMany('App\Models\AccountTradingRule', 'trading_rule_id', 'id');
    }
    

}
