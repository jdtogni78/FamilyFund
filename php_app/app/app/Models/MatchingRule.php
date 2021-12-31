<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MatchingRule
 *
 * @property $id
 * @property $name
 * @property $dollar_range_start
 * @property $dollar_range_end
 * @property $date_start
 * @property $date_end
 * @property $match_percent
 * @property $created
 * @property $updated
 *
 * @property AccountMatchingRule[] $accountMatchingRules
 * @property Transaction[] $transactions
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MatchingRule extends Model
{
    
    static $rules = [
		'name' => 'required',
		'date_start' => 'required',
		'date_end' => 'required',
		'match_percent' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','dollar_range_start','dollar_range_end','date_start','date_end','match_percent','created','updated'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountMatchingRules()
    {
        return $this->hasMany('App\Models\AccountMatchingRule', 'matching_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'matching_id', 'id');
    }
    

}
