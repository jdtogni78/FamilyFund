<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class AccountBalances
 * @package App\Models
 * @version January 4, 2022, 3:06 pm UTC
 *
 * @property \App\Models\Account $account
 * @property \App\Models\Transaction $tran
 * @property string $type
 * @property number $shares
 * @property integer $account_id
 * @property integer $tran_id
 * @property string $start_dt
 * @property string $end_dt
 */
class AccountBalances extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'account_balances';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'shares',
        'account_id',
        'tran_id',
        'start_dt',
        'end_dt'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'shares' => 'decimal:4',
        'account_id' => 'integer',
        'tran_id' => 'integer',
        'start_dt' => 'date',
        'end_dt' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'nullable|string|max:3',
        'shares' => 'nullable|numeric',
        'account_id' => 'required|integer',
        'tran_id' => 'nullable|integer',
        'start_dt' => 'required',
        'end_dt' => 'required',
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
    public function tran()
    {
        return $this->belongsTo(\App\Models\Transaction::class, 'tran_id');
    }
}
