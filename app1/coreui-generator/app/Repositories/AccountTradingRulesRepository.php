<?php

namespace App\Repositories;

use App\Models\AccountTradingRules;
use App\Repositories\BaseRepository;

/**
 * Class AccountTradingRulesRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:06 pm UTC
*/

class AccountTradingRulesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'account_id',
        'trading_rule_id'
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
        return AccountTradingRules::class;
    }
}
