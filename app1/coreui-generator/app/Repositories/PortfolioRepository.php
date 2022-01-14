<?php

namespace App\Repositories;

use App\Models\PortfolioExt;
use App\Repositories\BaseRepository;

/**
 * Class PortfolioRepository
 * @package App\Repositories
 * @version January 14, 2022, 4:54 am UTC
*/

class PortfolioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fund_id',
        'code'
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
        return PortfolioExt::class;
    }
}
