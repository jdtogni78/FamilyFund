<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePortfolioAPIRequest;
use App\Http\Requests\API\UpdatePortfolioAPIRequest;
use App\Http\Requests\API\GetPortfolioAPIRequest;

use App\Models\Portfolio;
use App\Models\PortfolioAsset;
use App\Repositories\PortfolioRepository;
use App\Repositories\PortfolioAssetRepository;
use App\Repositories\AssetPricesRepository;
use App\Repositories\AssetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\PortfolioAPIController;
use App\Http\Resources\PortfolioResource;
use Response;

/**
 * Class PortfolioControllerExt
 * @package App\Http\Controllers\API
 */

class PortfolioAPIControllerExt extends PortfolioAPIController
{
    public function __construct(PortfolioRepository $portfolioRepo)
    {
        parent::__construct($portfolioRepo);
    }

    /**
     * Display the specified Portfolio.
     * GET|HEAD /portfolios/{id}/as_of/{date}
     *
     * @param int $id
     *
     * @return Response
     */
    public function showAsOf($id, $as_of)
    {
        /** @var Portfolio $portfolio */
        $portfolio = $this->portfolioRepository->find($id);

        if (empty($portfolio)) {
            return $this->sendError('Portfolio not found');
        }

        $portfolioAssets = $portfolio->assetsAsOf($as_of);

        $rss = new PortfolioResource($portfolio);
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

            $assetsRepo = \App::make(AssetRepository::class);
            $assets = $assetsRepo->find($asset_id);
            $asset['name'] = $assets['name'];
            $assetPrices = $assets->pricesAsOf($as_of);
            
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
        $arr['as_of'] = $as_of;
        
        return $this->sendResponse($arr, 'Portfolio retrieved successfully');
    }

    /**
     * Display the specified Portfolio.
     * GET|HEAD /portfolios/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id) 
    {
        $now = date('Y-m-d');
        return $this->showAsOf($id, $now);
    }
}
