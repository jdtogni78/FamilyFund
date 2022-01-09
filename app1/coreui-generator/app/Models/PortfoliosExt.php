<?php

namespace App\Models;

use Eloquent as Model;
use App\Models\Portfolios;
use App\Models\PortfolioAssets;
use App\Repositories\PortfoliosRepository;
use App\Repositories\PortfolioAssetsRepository;

/**
 * Class PortfoliosExt
 * @package App\Models
 */
class PortfoliosExt extends Portfolios
{
    /**
     * @return money
     **/
    public function assetsAsOf($now)
    {
        $portfolioAssetsRepo = \App::make(PortfolioAssetsRepository::class);
        $query = $portfolioAssetsRepo->makeModel()->newQuery();
        $query->where('portfolio_id', $this->id);
        $query->whereDate('start_dt', '<=', $now);
        $query->whereDate('end_dt', '>', $now);
        $portfolioAssets = $query->get(['*']);
        return $portfolioAssets;
    }

    /**
     * @return money
     **/
    public function totalValue($now)
    {
        $portfolioAssets = $this->assetsAsOf($now);

        $totalValue = 0;
        foreach ($portfolioAssets as $pa) {
            $shares = $pa['shares'];
            $asset_id = $pa['asset_id'];
            if ($shares == 0) 
                continue;

            $asset = AssetsExt::findOrFail($asset_id);
            $assetPrices = $asset->pricesAsOf($now);
            
            if (count($assetPrices) == 1) {
                $price = $assetPrices[0]['price'];
                $value = ((int)($shares * $price * 100))/100;
                $totalValue += $value;
            } else {
                # TODO printf("No price for $asset_id\n");
            }
        }
        return $totalValue;
    }
}
