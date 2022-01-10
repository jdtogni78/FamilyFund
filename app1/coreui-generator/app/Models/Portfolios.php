<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Portfolios
 * @package App\Models
 * @version January 4, 2022, 3:07 pm UTC
 *
 * @property \App\Models\Fund $fund
 * @property \Illuminate\Database\Eloquent\Collection $portfolioAssets
 * @property integer $fund_id
 * @property number $last_total
 * @property string|\Carbon\Carbon $last_total_date
 */
class Portfolios extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'portfolios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'fund_id',
        'last_total',
        'last_total_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fund_id' => 'integer',
        'last_total' => 'decimal:2',
        'last_total_date' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fund_id' => 'required|integer',
        'last_total' => 'required|numeric',
        'last_total_date' => 'required',
        'created_at' => 'required',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function fund()
    {
        return $this->belongsTo(\App\Models\FundsExt::class, 'fund_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function portfolioAssets()
    {
        return $this->hasMany(\App\Models\PortfolioAssets::class, 'portfolio_id');
    }
}
