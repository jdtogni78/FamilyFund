<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PortfolioAsset
 *
 * @property $id
 * @property $portfolio_id
 * @property $asset_id
 * @property $shares
 * @property $created
 * @property $updated
 *
 * @property Asset $asset
 * @property Portfolio $portfolio
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PortfolioAsset extends Model
{
    
    static $rules = [
		'portfolio_id' => 'required',
		'asset_id' => 'required',
		'shares' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['portfolio_id','asset_id','shares','created','updated'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function asset()
    {
        return $this->hasOne('App\Models\Asset', 'id', 'asset_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function portfolio()
    {
        return $this->hasOne('App\Models\Portfolio', 'id', 'portfolio_id');
    }
    

}
