<?php

namespace App\Repositories;

use App\Models\PortfolioAssets;
use App\Repositories\BaseRepository;

/**
 * Class PortfolioAssetsRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:07 pm UTC
*/

class PortfolioAssetsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'portfolio_id',
        'asset_id',
        'shares',
        'start_dt',
        'end_dt'
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
        return PortfolioAssets::class;
    }
}
