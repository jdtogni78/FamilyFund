<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Transaction
 * @package App\Models
 * @version January 14, 2022, 4:54 am UTC
 *
 * @property \App\Models\Account $account
 * @property \App\Models\MatchingRule $matchingRule
 * @property \Illuminate\Database\Eloquent\Collection $accountBalances
 * @property string $source
 * @property string $type
 * @property number $value
 * @property number $shares
 * @property integer $account_id
 * @property integer $matching_rule_id
 */
class Transaction extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'transactions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'source',
        'type',
        'value',
        'shares',
        'account_id',
        'matching_rule_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'source' => 'string',
        'type' => 'string',
        'value' => 'decimal:2',
        'shares' => 'decimal:4',
        'account_id' => 'integer',
        'matching_rule_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'source' => 'required|string|max:3',
        'type' => 'required|string|max:3',
        'value' => 'required|numeric',
        'shares' => 'required|numeric',
        'account_id' => 'required',
        'matching_rule_id' => 'nullable',
        'updated_at' => 'nullable',
        'created_at' => 'required',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function account()
    {
        return $this->belongsTo(\App\Models\AccountExt::class, 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function matchingRule()
    {
        return $this->belongsTo(\App\Models\MatchingRule::class, 'matching_rule_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function accountBalances()
    {
        return $this->hasMany(\App\Models\AccountBalance::class, 'transaction_id');
    }
}
