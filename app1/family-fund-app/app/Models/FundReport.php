<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FundReport
 * @package App\Models
 * @version February 11, 2024, 6:58 pm UTC
 *
 * @property \App\Models\Fund $fund
 * @property \Illuminate\Database\Eloquent\Collection $fundReportSchedules
 * @property integer $fund_id
 * @property string $type
 * @property string $as_of
 */
class FundReport extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'fund_reports';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'fund_id',
        'type',
        'as_of'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fund_id' => 'integer',
        'type' => 'string',
        'as_of' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fund_id' => 'required',
        'type' => 'required|in:ALL,ADM',
        'as_of' => 'required',
        'updated_at' => 'nullable',
        'created_at' => 'nullable',
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
    public function fundReportSchedules()
    {
        return $this->hasMany(\App\Models\FundReportSchedule::class, 'fund_report_id');
    }
}
