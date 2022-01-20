<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TransactionMatching
 * @package App\Models
 * @version January 19, 2022, 1:19 am UTC
 *
 * @property \App\Models\Transaction $transaction
 * @property \App\Models\Transaction $transaction1
 * @property \App\Models\MatchingRule $matchingRule
 * @property integer $matching_rule_id
 * @property integer $transaction_id
 * @property integer $reference_transaction_id
 */
class TransactionMatching extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'transaction_matchings';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'matching_rule_id',
        'transaction_id',
        'reference_transaction_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'matching_rule_id' => 'integer',
        'transaction_id' => 'integer',
        'reference_transaction_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'matching_rule_id' => 'nullable',
        'transaction_id' => 'required',
        'reference_transaction_id' => 'required',
        'updated_at' => 'nullable',
        'created_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function transaction()
    {
        return $this->hasOne(\App\Models\TransactionExt::class, 'id', 'transaction_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function referenceTransaction()
    {
        return $this->hasOne(\App\Models\TransactionExt::class, 'id', 'reference_transaction_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function matchingRule()
    {
        return $this->belongsTo(\App\Models\MatchingRule::class, 'matching_rule_id');
    }
}
