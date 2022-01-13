<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Transactions
 * @package App\Models
 * @version January 4, 2022, 3:07 pm UTC
 *
 * @property \App\Models\Account $account
 * @property \App\Models\MatchingRule $matching
 * @property \Illuminate\Database\Eloquent\Collection $accountBalances
 * @property string $source
 * @property string $type
 * @property number $shares
 * @property integer $account_id
 * @property integer $matching_id
 */
class Transactions extends Model
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
        'shares',
        'account_id',
        'matching_id'
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
        'shares' => 'decimal:4',
        'account_id' => 'integer',
        'matching_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'source' => 'nullable|string|max:3',
        'type' => 'nullable|string|max:3',
        'shares' => 'nullable|numeric',
        'account_id' => 'required|integer',
        'matching_id' => 'nullable|integer',
        'created_at' => 'required',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function account()
    {
        return $this->belongsTo(\App\Models\Accounts::class, 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function matching()
    {
        return $this->belongsTo(\App\Models\MatchingRules::class, 'matching_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function accountBalances()
    {
        return $this->hasMany(\App\Models\AccountBalances::class, 'tran_id');
    }
}
