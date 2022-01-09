<?php

namespace App\Repositories;

use App\Models\PortfoliosExt;
use App\Repositories\BaseRepository;

/**
 * Class PortfoliosRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:07 pm UTC
*/

class PortfoliosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fund_id',
        'last_total',
        'last_total_date'
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
        return PortfoliosExt::class;
    }
}
