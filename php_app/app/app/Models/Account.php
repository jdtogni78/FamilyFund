<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 *
 * @property $id
 * @property $code
 * @property $nickname
 * @property $email_cc
 * @property $user_id
 * @property $fund_id
 * @property $created
 * @property $updated
 *
 * @property AccountBalance[] $accountBalances
 * @property AccountMatchingRule[] $accountMatchingRules
 * @property AccountTradingRule[] $accountTradingRules
 * @property Fund $fund
 * @property Transaction[] $transactions
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Account extends Model
{
    
    static $rules = [
		'code' => 'required',
		'user_id' => 'required',
		'fund_id' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code','nickname','email_cc','user_id','fund_id','created','updated'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountBalances()
    {
        return $this->hasMany('App\Models\AccountBalance', 'account_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountMatchingRules()
    {
        return $this->hasMany('App\Models\AccountMatchingRule', 'account_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountTradingRules()
    {
        return $this->hasMany('App\Models\AccountTradingRule', 'account_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fund()
    {
        return $this->hasOne('App\Models\Fund', 'id', 'fund_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'account_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
