<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Portfolio
 *
 * @property $id
 * @property $fund_id
 * @property $last_total
 * @property $last_total_date
 * @property $created
 * @property $updated
 *
 * @property Fund $fund
 * @property PortfolioAsset[] $portfolioAssets
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Portfolio extends Model
{
    
    static $rules = [
		'fund_id' => 'required',
		'last_total' => 'required',
		'last_total_date' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fund_id','last_total','last_total_date','created','updated'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fund()
    {
        return $this->hasOne('App\Models\Fund', 'id', 'fund_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function portfolioAssets()
    {
        return $this->hasMany('App\Models\PortfolioAsset', 'portfolio_id', 'id');
    }
    

}
