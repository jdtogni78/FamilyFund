<?php

namespace App\Http\Controllers\APIv1;

use App\Http\Requests\API\CreatePortfolioAPIRequest;
use App\Http\Requests\API\UpdatePortfolioAPIRequest;
use App\Http\Requests\API\AssetsUpdatePortfolioAPIRequest;

use App\Models\Utils;
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
            $asset_id = $pa->asset_id;
            $position = $pa->position;

            if ($position == 0) 
                continue;

            $asset['asset_id'] = $asset_id;
            $asset['position'] = Utils::position($position);
            $a = $pa->asset()->first();
            $asset['name'] = $a->name;
            $assetPrices = $a->pricesAsOf($as_of);
            
            if (count($assetPrices) == 1) {
                $price = $assetPrices[0]['price'];
                $value = $position * $price;
                $totalValue += $value;
                $asset['price'] = Utils::currency($price);
                $asset['value'] = Utils::currency($value);
            } else {
                # TODO printf("No price for $asset_id\n");
            }
            array_push($arr['assets'], $asset);
        }
        $arr['total_value'] = Utils::currency($totalValue);
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
    
    /**
     * Update the specified Portfolio in storage.
     * PUT/PATCH /portfolios/{code}/bulk_update
     *
     * @param int $code
     * @param AssetsUpdatePortfolioAPIRequest $request
     *
     * @return Response
     */
    public function assetsUpdate($code, AssetsUpdatePortfolioAPIRequest $request)
    {
        $input = $request->all();

        // /** @var Portfolio $portfolio */
        $portfolio = Portfolio::where('code', '=', $code)->first();

        if (empty($portfolio)) {
            return $this->sendError('Portfolio not found');
        }

        // print_r($portfolio->toArray());
        // print_r($input);
        foreach($input as $symbol => $values) {
            $price = $values['price'];
            $position = $values['position'];

            $asset = Asset::
                where('feed_id', '=', $symbol)
                ->where('source_feed', '=', $code)
                ->first();
            if ($asset == null) {
                
            }
        }

        return $this->sendResponse(new PortfolioResource($portfolio), 'Portfolio updated successfully');
    }
}
