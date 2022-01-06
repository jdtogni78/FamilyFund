<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class MatchingRules
 * @package App\Models
 * @version January 4, 2022, 3:07 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $accountMatchingRules
 * @property \Illuminate\Database\Eloquent\Collection $transactions
 * @property string $name
 * @property number $dollar_range_start
 * @property number $dollar_range_end
 * @property string $date_start
 * @property string $date_end
 * @property number $match_percent
 */
class MatchingRules extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'matching_rules';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'dollar_range_start',
        'dollar_range_end',
        'date_start',
        'date_end',
        'match_percent'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'dollar_range_start' => 'decimal:2',
        'dollar_range_end' => 'decimal:2',
        'date_start' => 'date',
        'date_end' => 'date',
        'match_percent' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:50',
        'dollar_range_start' => 'nullable|numeric',
        'dollar_range_end' => 'nullable|numeric',
        'date_start' => 'required',
        'date_end' => 'required',
        'match_percent' => 'required|numeric',
        'created_at' => 'required',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function accountMatchingRules()
    {
        return $this->hasMany(\App\Models\AccountMatchingRule::class, 'matching_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function transactions()
    {
        return $this->hasMany(\App\Models\Transaction::class, 'matching_id');
    }
}
