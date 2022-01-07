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
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PortfoliosResource;
use Response;

/**
 * Class PortfoliosController
 * @package App\Http\Controllers\API
 */

class PortfoliosAPIController extends AppBaseController
{
    /** @var  PortfoliosRepository */
    private $portfoliosRepository;

    public function __construct(PortfoliosRepository $portfoliosRepo)
    {
        $this->portfoliosRepository = $portfoliosRepo;
    }

    /**
     * Display a listing of the Portfolios.
     * GET|HEAD /portfolios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $portfolios = $this->portfoliosRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PortfoliosResource::collection($portfolios), 'Portfolios retrieved successfully');
    }

    /**
     * Store a newly created Portfolios in storage.
     * POST /portfolios
     *
     * @param CreatePortfoliosAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePortfoliosAPIRequest $request)
    {
        $input = $request->all();

        $portfolios = $this->portfoliosRepository->create($input);

        return $this->sendResponse(new PortfoliosResource($portfolios), 'Portfolios saved successfully');
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
            return $this->sendError('Portfolios not found');
        }

        $now = date('Y-m-d');

        $portfolioAssetsRepo = \App::make(PortfolioAssetsRepository::class);
        $query = $portfolioAssetsRepo->makeModel()->newQuery();
        $query->where('portfolio_id', $id);
        $query->whereDate('start_dt', '<=', $now);
        $query->whereDate('end_dt', '>=', $now);
        $portfolioAssets = $query->get(['*']);

        $rss = new PortfoliosResource($portfolios);
        $arr = $rss->toArray(NULL);
        // var_dump($arr);
        // PortfolioAssetsResource::collection($portfolioAssets);
        // $arr['assets'] = PortfolioAssetsResource::collection($portfolioAssets);
        // $pa = new PortfolioAssetsResource($portfolioAssets);
        // $arr['assets'] = $pa->toArray(NULL);

        $totalValue = 0;
        $arr['assets'] = array();
        foreach ($portfolioAssets as $pa) {
            $asset = array();
            $asset_id = $pa['asset_id'];
            $shares = $pa['shares'];
            $asset['asset_id'] = $asset_id;
            $asset['shares'] = $shares;

            $assetPricesRepo = \App::make(AssetPricesRepository::class);
            $assetsRepo = \App::make(AssetsRepository::class);

            $assets = $assetsRepo->find($asset_id);
            $asset['name'] = $assets['name'];

            $query = $assetPricesRepo->makeModel()->newQuery();
            $query->where('asset_id', $asset_id);
            $query->whereDate('start_dt', '<=', $now);
            $query->whereDate('end_dt', '>=', $now);
            $assetPrices = $query->get(['*']);
            
            if (count($assetPrices) == 1) {
                $price = $assetPrices[0]['price'];
                $value = $shares * $price;
                $totalValue += $value;
                $asset['price'] = $price;
                $asset['value'] = $value;
            } else {
                # TODO printf("No price for $asset_id\n");
            }
            array_push($arr['assets'], $asset);
        }
        $arr['total_value'] = $totalValue;
        
        return $this->sendResponse($arr, 'Portfolios retrieved successfully');
    }

    /**
     * Update the specified Portfolios in storage.
     * PUT/PATCH /portfolios/{id}
     *
     * @param int $id
     * @param UpdatePortfoliosAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePortfoliosAPIRequest $request)
    {
        $input = $request->all();

        /** @var Portfolios $portfolios */
        $portfolios = $this->portfoliosRepository->find($id);

        if (empty($portfolios)) {
            return $this->sendError('Portfolios not found');
        }

        $portfolios = $this->portfoliosRepository->update($input, $id);

        return $this->sendResponse(new PortfoliosResource($portfolios), 'Portfolios updated successfully');
    }

    /**
     * Remove the specified Portfolios from storage.
     * DELETE /portfolios/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Portfolios $portfolios */
        $portfolios = $this->portfoliosRepository->find($id);

        if (empty($portfolios)) {
            return $this->sendError('Portfolios not found');
        }

        $portfolios->delete();

        return $this->sendSuccess('Portfolios deleted successfully');
    }
}
