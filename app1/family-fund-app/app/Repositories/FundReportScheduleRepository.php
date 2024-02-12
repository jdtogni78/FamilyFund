<?php

namespace App\Repositories;

use App\Models\FundReportScheduleExt;
use App\Repositories\BaseRepository;

/**
 * Class FundReportScheduleRepository
 * @package App\Repositories
 * @version February 11, 2024, 11:54 pm UTC
*/

class FundReportScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fund_report_id',
        'schedule_id',
        'start_dt',
        'end_dt'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FundReportScheduleExt::class;
    }
}