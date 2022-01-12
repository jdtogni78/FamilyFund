<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePortfoliosAPIRequest;
use App\Http\Requests\API\UpdatePortfoliosAPIRequest;
use App\Models\Portfolios;
use App\Models\PortfolioAssets;
use App\Repositories\PortfoliosRepository;
use App\Repositories\PortfolioAssetsRepository;
use App\Repositories\AssetPricesRepository;
use App\Repositories\AssetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\PortfoliosAPIController;
use App\Http\Resources\PortfoliosResource;
use Response;

/**
 * Class PortfoliosControllerExt
 * @package App\Http\Controllers\API
 */

class PortfoliosAPIControllerExt extends PortfoliosAPIController
{
    public function __construct(PortfoliosRepository $portfoliosRepo)
    {
        parent::__construct($portfoliosRepo);
    }

    /**
     * Display the specified Portfolios.
     * GET|HEAD /portfolios/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Portfolios $portfolios */
        $portfolios = $this->portfoliosRepository->find($id);

        if (empty($portfolios)) {
            return $this->sendError('Portfolio not found');
        }

        $now = date('Y-m-d');

        $portfolioAssets = $portfolios->assetsAsOf($now);

        $rss = new PortfoliosResource($portfolios);
        $arr = $rss->toArray(NULL);

        $totalValue = 0;
        $arr['assets'] = array();
        foreach ($portfolioAssets as $pa) {
            $asset = array();
            $asset_id = $pa['asset_id'];
            $shares = $pa['shares'];

            if ($shares == 0) 
                continue;

            $asset['asset_id'] = $asset_id;
            $asset['shares'] = $shares;

            $assetsRepo = \App::make(AssetsRepository::class);
            $assets = $assetsRepo->find($asset_id);
            $asset['name'] = $assets['name'];
            $assetPrices = $assets->pricesAsOf($now);
            
            if (count($assetPrices) == 1) {
                $price = $assetPrices[0]['price'];
                $value = ((int)($shares * $price * 100))/100;
                $totalValue += $value;
                $asset['price'] = $price;
                $asset['value'] = $value;
            } else {
                # TODO printf("No price for $asset_id\n");
            }
            array_push($arr['assets'], $asset);
        }
        $arr['total_value'] = $totalValue;
        $arr['as_of'] = $now;
        
        return $this->sendResponse($arr, 'Portfolios retrieved successfully');
    }
}
