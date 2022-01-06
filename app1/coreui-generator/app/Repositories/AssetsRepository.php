<?php

namespace App\Repositories;

use App\Models\Assets;
use App\Repositories\BaseRepository;

/**
 * Class AssetsRepository
 * @package App\Repositories
 * @version January 4, 2022, 3:07 pm UTC
*/

class AssetsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type',
        'source_feed',
        'feed_id',
        'last_price',
        'last_price_date',
        'deactivated'
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
        return Assets::class;
    }
}
