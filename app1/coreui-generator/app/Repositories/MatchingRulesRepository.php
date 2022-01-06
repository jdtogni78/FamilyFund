<?php

namespace App\Repositories;

use App\Models\MatchingRules;
use App\Repositories\BaseRepository;

/**
 * Class MatchingRulesRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:07 pm UTC
*/

class MatchingRulesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'dollar_range_start',
        'dollar_range_end',
        'date_start',
        'date_end',
        'match_percent'
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
        return MatchingRules::class;
    }
}
