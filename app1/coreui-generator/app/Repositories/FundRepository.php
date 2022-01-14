<?php

namespace App\Repositories;

use App\Models\Fund;
use App\Repositories\BaseRepository;

/**
 * Class FundRepository
 * @package App\Repositories
 * @version January 14, 2022, 4:54 am UTC
*/

class FundRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'goal'
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
        return Fund::class;
    }
}
