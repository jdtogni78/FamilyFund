<?php

namespace App\Repositories;

use App\Models\Funds;
use App\Repositories\BaseRepository;

/**
 * Class FundsRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:07 pm UTC
*/

class FundsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'goal',
        'total_shares'
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
        return Funds::class;
    }
}
