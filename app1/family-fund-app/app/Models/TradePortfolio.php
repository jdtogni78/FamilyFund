<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TradePortfolio
 * @package App\Models
 * @version January 3, 2024, 3:56 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $tradePortfolioItems
 * @property \App\Models\Fund $fund
 * @property string $account_name
 * @property integer $fund_id
 * @property number $cash_target
 * @property number $cash_reserve_target
 * @property number $max_single_order
 * @property number $minimum_order
 * @property integer $rebalance_period
 * @property string $start_dt
 * @property string $end_dt
 */
class TradePortfolio extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'trade_portfolios';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'account_name',
        'fund_id',
        'cash_target',
        'cash_reserve_target',
        'max_single_order',
        'minimum_order',
        'rebalance_period',
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
        'account_name' => 'string',
        'fund_id' => 'integer',
        'cash_target' => 'decimal:2',
        'cash_reserve_target' => 'decimal:2',
        'max_single_order' => 'decimal:2',
        'minimum_order' => 'decimal:2',
        'rebalance_period' => 'integer',
        'start_dt' => 'date',
        'end_dt' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'account_name' => 'nullable|string|max:50|nullable|string|max:50',
        'fund_id' => 'required',
        'cash_target' => 'required|numeric:between:0,0.99',
        'cash_reserve_target' => 'required|numeric:between:0,0.99',
        'max_single_order' => 'required|numeric',
        'minimum_order' => 'required|numeric',
        'rebalance_period' => 'required|integer|integer',
        'updated_at' => 'nullable',
        'created_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tradePortfolioItems()
    {
        return $this->hasMany(\App\Models\TradePortfolioItem::class, 'trade_portfolio_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function fund()
    {
        return $this->belongsTo(\App\Models\FundExt::class, 'fund_id');
    }
}
