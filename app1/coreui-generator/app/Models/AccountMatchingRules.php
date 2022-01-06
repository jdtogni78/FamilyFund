<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class AccountMatchingRules
 * @package App\Models
 * @version January 4, 2022, 3:06 pm UTC
 *
 * @property \App\Models\Account $account
 * @property \App\Models\MatchingRule $matching
 * @property integer $account_id
 * @property integer $matching_id
 * @property string|\Carbon\Carbon $created
 * @property string|\Carbon\Carbon $updated
 */
class AccountMatchingRules extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'account_matching_rules';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'account_id',
        'matching_id',
        'created',
        'updated'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'account_id' => 'integer',
        'matching_id' => 'integer',
        'created' => 'datetime',
        'updated' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'account_id' => 'required|integer',
        'matching_id' => 'required|integer',
        'created' => 'required',
        'updated' => 'nullable'
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
    public function matching()
    {
        return $this->belongsTo(\App\Models\MatchingRule::class, 'matching_id');
    }
}
