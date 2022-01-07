<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class AssetPrices
 * @package App\Models
 * @version January 4, 2022, 3:07 pm UTC
 *
 * @property \App\Models\Asset $asset
 * @property integer $asset_id
 * @property number $price
 * @property string $start_dt
 * @property string $end_dt
 */
class AssetPrices extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'asset_prices';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'asset_id',
        'price',
        'start_dt',
        'end_dt'
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
        'asset_id' => 'integer',
        'price' => 'decimal:2',
        'start_dt' => 'date',
        'end_dt' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'asset_id' => 'nullable',
        'price' => 'required|numeric',
        'start_dt' => 'required',
        'end_dt' => 'required',
        'created_at' => 'required',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function asset()
    {
        return $this->belongsTo(\App\Models\Asset::class, 'asset_id');
    }
}
