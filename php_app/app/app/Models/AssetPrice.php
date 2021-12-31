<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetPrice
 *
 * @property $id
 * @property $asset_id
 * @property $price
 * @property $created
 *
 * @property Asset $asset
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AssetPrice extends Model
{
    
    static $rules = [
		'price' => 'required',
		'created' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['asset_id','price','created'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function asset()
    {
        return $this->hasOne('App\Models\Asset', 'id', 'asset_id');
    }
    

}
