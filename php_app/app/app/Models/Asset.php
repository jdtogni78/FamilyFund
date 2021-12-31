<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Asset
 *
 * @property $id
 * @property $name
 * @property $type
 * @property $source_feed
 * @property $feed_id
 * @property $last_price
 * @property $last_price_date
 * @property $deactivated
 * @property $created
 * @property $updated
 *
 * @property AssetPrice[] $assetPrices
 * @property PortfolioAsset[] $portfolioAssets
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Asset extends Model
{
    
    static $rules = [
		'name' => 'required',
		'type' => 'required',
		'source_feed' => 'required',
		'feed_id' => 'required',
		'last_price' => 'required',
		'last_price_date' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','type','source_feed','feed_id','last_price','last_price_date','deactivated','created','updated'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assetPrices()
    {
        return $this->hasMany('App\Models\AssetPrice', 'asset_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function portfolioAssets()
    {
        return $this->hasMany('App\Models\PortfolioAsset', 'asset_id', 'id');
    }
    

}
