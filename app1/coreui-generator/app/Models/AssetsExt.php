<?php

namespace App\Models;

use App\Models\Assets;
use App\Repositories\AssetPricesRepository;

/**
 * Class AssetsExt
 * @package App\Models
 */
class AssetsExt extends Assets
{
    /**
     **/
    public function pricesAsOf($now)
    {
        $assetPricesRepo = \App::make(AssetPricesRepository::class);
        $query = $assetPricesRepo->makeModel()->newQuery();
        $query->where('asset_id', $this->id);
        $query->whereDate('start_dt', '<=', $now);
        $query->whereDate('end_dt', '>', $now);
        $assetPrices = $query->get(['*']);
        return $assetPrices;
    }
}
