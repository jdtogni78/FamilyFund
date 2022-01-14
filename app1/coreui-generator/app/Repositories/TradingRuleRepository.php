<?php

namespace App\Repositories;

use App\Models\TradingRule;
use App\Repositories\BaseRepository;

/**
 * Class TradingRuleRepository
 * @package App\Repositories
 * @version January 14, 2022, 4:54 am UTC
*/

class TradingRuleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'max_sale_increase_pcnt',
        'min_fund_performance_pcnt'
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
        return TradingRule::class;
    }
}
