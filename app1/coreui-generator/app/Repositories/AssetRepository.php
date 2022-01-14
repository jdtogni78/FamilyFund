<?php

namespace App\Repositories;

use App\Models\Asset;
use App\Repositories\BaseRepository;

/**
 * Class AssetRepository
 * @package App\Repositories
 * @version January 14, 2022, 4:54 am UTC
*/

class AssetRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type',
        'source_feed',
        'feed_id'
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
        return Asset::class;
    }
}
