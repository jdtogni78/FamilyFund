<?php

namespace App\Repositories;

use App\Models\AssetPrices;
use App\Repositories\BaseRepository;

/**
 * Class AssetPricesRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:07 pm UTC
*/

class AssetPricesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'asset_id',
        'price',
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
        return AssetPrices::class;
    }
}
