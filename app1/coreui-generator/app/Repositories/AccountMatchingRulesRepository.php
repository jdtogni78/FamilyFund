<?php

namespace App\Repositories;

use App\Models\AccountMatchingRules;
use App\Repositories\BaseRepository;

/**
 * Class AccountMatchingRulesRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:06 pm UTC
*/

class AccountMatchingRulesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'account_id',
        'matching_id',
        'created',
        'updated'
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
        return AccountMatchingRules::class;
    }
}
