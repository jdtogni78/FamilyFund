<?php

namespace App\Repositories;

use App\Models\TradingRules;
use App\Repositories\BaseRepository;

/**
 * Class TradingRulesRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:07 pm UTC
*/

class TradingRulesRepository extends BaseRepository
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
        return TradingRules::class;
    }
}
