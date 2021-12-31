<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AccountMatchingRule
 *
 * @property $id
 * @property $account_id
 * @property $matching_id
 * @property $created
 * @property $updated
 *
 * @property Account $account
 * @property MatchingRule $matchingRule
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AccountMatchingRule extends Model
{
    
    static $rules = [
		'account_id' => 'required',
		'matching_id' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['account_id','matching_id','created','updated'];


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
    public function matchingRule()
    {
        return $this->hasOne('App\Models\MatchingRule', 'id', 'matching_id');
    }
    

}
