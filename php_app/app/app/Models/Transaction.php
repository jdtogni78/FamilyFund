<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 *
 * @property $id
 * @property $source
 * @property $type
 * @property $shares
 * @property $account_id
 * @property $matching_id
 * @property $created
 * @property $updated
 *
 * @property Account $account
 * @property AccountBalance[] $accountBalances
 * @property MatchingRule $matchingRule
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Transaction extends Model
{
    
    static $rules = [
		'account_id' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['source','type','shares','account_id','matching_id','created','updated'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        return $this->hasOne('App\Models\Account', 'id', 'account_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountBalances()
    {
        return $this->hasMany('App\Models\AccountBalance', 'tran_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function matchingRule()
    {
        return $this->hasOne('App\Models\MatchingRule', 'id', 'matching_id');
    }
    

}
