<?php

namespace App\Models;

use Eloquent as Model;
use App\Models\Portfolio;
use App\Models\PortfolioAsset;
use App\Models\AssetExt;
use App\Models\Utils;
use App\Repositories\PortfolioRepository;
use App\Repositories\PortfolioAssetRepository;
use DB;

/**
 * Class PortfolioExt
 * @package App\Models
 */
class PortfolioExt extends Portfolio
{
    /**
     * Validation rules (GET)
     *
     * @var array
     */
    public static $get_rules = [
        // 'id' => 'required',
        // 'as_of' => 'nullable|string|max:10'
    ];

    /**
     * @return money
     **/
    public function assetsAsOf($now, $verbose=false)
    {
        if ($verbose) DB::enableQueryLog(); // Enable query log

        $portfolioAssetsRepo = \App::make(PortfolioAssetRepository::class);
        $query = $portfolioAssetsRepo->makeModel()->newQuery();
        $query->where('portfolio_id', $this->id);
        $query->whereDate('start_dt', '<=', $now);
        $query->whereDate('end_dt', '>', $now);
        $portfolioAssets = $query->get(['*']);
        if ($verbose) {
            // print_r(DB::getQueryLog());
            foreach ($portfolioAssets as $portfolioAsset) {
                print_r(json_encode($portfolioAsset->toArray()) . "\n");
            }
        }
        

        return $portfolioAssets;
    }

    /**
     * @return money
     **/
    public function valueAsOf($now, $verbose=false)
    {
        $portfolioAssets = $this->assetsAsOf($now);

        $totalValue = 0;
        foreach ($portfolioAssets as $pa) {
            $position = $pa->position;
            $asset_id = $pa->asset_id;
            if ($position == 0) 
                continue;

            $asset = AssetExt::findOrFail($asset_id);
            $assetPrice = $asset->pricesAsOf($now);
            
            if (count($assetPrice) == 1) {
                $price = $assetPrice[0]['price'];
                $value = $position * $price;
                $totalValue += $value;
                if ($verbose) {
                    // print_r(json_encode($pa->toArray())."\n");
                    // print_r(json_encode($assetPrice[0]->toArray())."\n");
                    print_r(json_encode([$asset_id, $position, $price, $value])."\n");
                }
            } else {
                # TODO printf("No price for $asset_id\n");
            }
        }
        // $totalValue = round($totalValue,4);
        if ($verbose) {
            print('id '.$this->id."\n");
            print('asOf '.$now."\n");
            print('totalvalue '.$totalValue."\n");
        }
        return $totalValue;
    }

    public function periodPerformance($from, $to)
    {
        $valueFrom = $this->valueAsOf($from);
        $valueTo = $this->valueAsOf($to);
        // var_dump(array($from, $to, $valueFrom, $valueTo));
        if ($valueFrom == 0) return 0;
        return $valueTo/$valueFrom - 1;
    }

    public function yearlyPerformance($year)
    {
        $from = $year.'-01-01';
        $to = ($year+1).'-01-01';
        return $this->periodPerformance($from, $to);
    }
}
