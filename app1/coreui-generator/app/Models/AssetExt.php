<?php

namespace App\Models;

use App\Models\Asset;
use App\Repositories\AssetPriceRepository;

/**
 * Class AssetExt
 * @package App\Models
 */
class AssetExt extends Asset
{
    /**
     **/
    public function pricesAsOf($now)
    {
        $assetPricesRepo = \App::make(AssetPriceRepository::class);
        $query = $assetPricesRepo->makeModel()->newQuery();
        $query->where('asset_id', $this->id);
        $query->whereDate('start_dt', '<=', $now);
        $query->whereDate('end_dt', '>', $now);
        $assetPrices = $query->get(['*']);
        if ($assetPrices->count() > 1) {
            throw new \Exception("There should only be one asset price (found " . $assetPrices->count() . ") for asset " . $this->id . ' at ' . $now);
        }
        return $assetPrices;
    }
}
