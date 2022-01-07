<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Assets
 * @package App\Models
 * @version January 4, 2022, 3:07 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $assetPrices
 * @property \Illuminate\Database\Eloquent\Collection $portfolioAssets
 * @property string $name
 * @property string $type
 * @property string $source_feed
 * @property string $feed_id
 * @property number $last_price
 * @property string $last_price_date
 * @property string|\Carbon\Carbon $deactivated
 */
class Assets extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'assets';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'type',
        'feed_id',
        'source_feed',
        'last_price_date',
        'last_price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'type' => 'string',
        'source_feed' => 'string',
        'feed_id' => 'string',
        'last_price' => 'decimal:2',
        'last_price_date' => 'date',
        'deactivated' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:128',
        'type' => 'required|string|max:3',
        'source_feed' => 'required|string|max:50',
        'feed_id' => 'required|string|max:128',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function assetPrices()
    {
        return $this->hasMany(\App\Models\AssetPrice::class, 'asset_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function portfolioAssets()
    {
        return $this->hasMany(\App\Models\PortfolioAsset::class, 'asset_id');
    }
}
