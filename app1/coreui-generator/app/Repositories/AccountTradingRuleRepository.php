<?php

namespace App\Repositories;

use App\Models\AccountTradingRule;
use App\Repositories\BaseRepository;

/**
 * Class AccountTradingRuleRepository
 * @package App\Repositories
 * @version January 14, 2022, 4:53 am UTC
*/

class AccountTradingRuleRepository extends BaseRepository
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
        return AccountTradingRule::class;
    }
}
