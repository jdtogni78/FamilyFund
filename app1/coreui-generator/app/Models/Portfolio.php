<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Portfolio
 * @package App\Models
 * @version January 14, 2022, 4:54 am UTC
 *
 * @property \App\Models\Fund $fund
 * @property \Illuminate\Database\Eloquent\Collection $portfolioAssets
 * @property integer $fund_id
 * @property string $code
 */
class Portfolio extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'portfolios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'fund_id',
        'code'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fund_id' => 'integer',
        'code' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fund_id' => 'required',
        'code' => 'required|string|max:30',
        'updated_at' => 'nullable',
        'created_at' => 'required',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function fund()
    {
        return $this->belongsTo(\App\Models\Fund::class, 'fund_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function portfolioAssets()
    {
        return $this->hasMany(\App\Models\PortfolioAsset::class, 'portfolio_id');
    }
}
