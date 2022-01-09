<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Funds
 * @package App\Models
 * @version January 4, 2022, 3:07 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $accounts
 * @property \Illuminate\Database\Eloquent\Collection $portfolios
 * @property string $name
 * @property string $goal
 * @property number $total_shares
 */
class Funds extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'funds';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'goal',
        'total_shares'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'goal' => 'string',
        'total_shares' => 'decimal:4'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:30',
        'goal' => 'nullable|string|max:1024',
        'total_shares' => 'required|numeric',
        'created_at' => 'required',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function accounts()
    {
        return $this->hasMany(\App\Models\Accounts::class, 'fund_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function portfolios()
    {
        return $this->hasMany(\App\Models\Portfolios::class, 'fund_id');
    }
}
