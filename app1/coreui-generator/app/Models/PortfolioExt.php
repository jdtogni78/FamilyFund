<?php

namespace App\Models;

use Eloquent as Model;
use App\Models\Portfolio;
use App\Models\PortfolioAsset;
use App\Models\AssetExt;
use App\Repositories\PortfolioRepository;
use App\Repositories\PortfolioAssetRepository;

/**
 * Class PortfolioExt
 * @package App\Models
 */
class PortfolioExt extends Portfolio
{
    /**
     * @return money
     **/
    public function assetsAsOf($now)
    {
        $portfolioAssetsRepo = \App::make(PortfolioAssetRepository::class);
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
    public function valueAsOf($now)
    {
        $portfolioAssets = $this->assetsAsOf($now);

        $totalValue = 0;
        foreach ($portfolioAssets as $pa) {
            $shares = $pa['shares'];
            $asset_id = $pa['asset_id'];
            if ($shares == 0) 
                continue;

            $asset = AssetExt::findOrFail($asset_id);
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

    public function periodPerformance($from, $to)
    {
        $valueFrom = $this->valueAsOf($from);
        $valueTo = $this->valueAsOf($to);
        // var_dump(array($from, $to, $valueFrom, $valueTo));
        if ($valueFrom == 0) return 0;
        return ((int) (($valueTo/$valueFrom - 1)*10000))/100;
    }

    public function yearlyPerformance($year)
    {
        $from = $year.'-01-01';
        $to = ($year+1).'-01-01';
        return $this->periodPerformance($from, $to);
    }
}
