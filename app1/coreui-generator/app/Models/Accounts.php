<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Accounts
 * @package App\Models
 * @version January 4, 2022, 6:08 pm UTC
 *
 * @property \App\Models\Funds $fund
 * @property \App\Models\Fund $fund
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $accountBalances
 * @property \Illuminate\Database\Eloquent\Collection $accountMatchingRules
 * @property \Illuminate\Database\Eloquent\Collection $accountTradingRules
 * @property \Illuminate\Database\Eloquent\Collection $transactions
 * @property string $code
 * @property string $nickname
 * @property string $email_cc
 * @property integer $user_id
 */
class Accounts extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'accounts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'nickname',
        'email_cc',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'nickname' => 'string',
        'email_cc' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required|string|max:15|string|max:15',
        'nickname' => 'nullable|string|max:15|nullable|string|max:15',
        'email_cc' => 'nullable|string|max:1024|nullable|string|max:1024',
        'user_id' => 'required',
        'created_at' => 'required',
        'updated_at' => 'nullable|nullable',
        'deleted_at' => 'nullable|nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function fund()
    {
        return $this->belongsTo(\App\Models\FundsExt::class, 'fund_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function accountBalances()
    {
        return $this->hasMany(\App\Models\AccountBalances::class, 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function accountMatchingRules()
    {
        return $this->hasMany(\App\Models\AccountMatchingRules::class, 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function accountTradingRules()
    {
        return $this->hasMany(\App\Models\AccountTradingRules::class, 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function transactions()
    {
        return $this->hasMany(\App\Models\Transactions::class, 'account_id');
    }
}
