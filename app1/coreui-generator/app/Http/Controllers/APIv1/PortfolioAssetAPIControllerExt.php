<?php

namespace App\Http\Controllers\APIv1;

use App\Http\Controllers\API\PortfolioAssetAPIController;
use App\Http\Requests\API\CreatePortfolioAssetAPIRequest;
use App\Http\Requests\API\CreatePositionUpdateAPIRequest;
use App\Models\AssetExt;
use App\Models\Portfolio;
use App\Models\PortfolioAsset;
use App\Models\PortfolioExt;
use App\Models\PositionUpdate;
use App\Repositories\PortfolioAssetRepository;
use Nette\Schema\ValidationException;
use function PHPUnit\Framework\isEmpty;

class PortfolioAssetAPIControllerExt extends PortfolioAssetAPIController
{
    use BulkStore;

    public function __construct(PortfolioAssetRepository $PortfolioAssetsRepo)
    {
        parent::__construct($PortfolioAssetsRepo);
    }

    /**
     * Store a newly created PortfolioAssetCollection in storage.
     * POST /PortfolioAssetBulkUpdate
     *
     * @param CreatePositionUpdateAPIRequest $request
     *
     * @return Response
     */
    public function bulkStore(CreatePositionUpdateAPIRequest $request)
    {
        return $this->genericBulkStore($request, 'position');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePortfolioAssetAPIRequest $request)
    {
        $input = $request->all();

        $PortfolioAsset = $this->insertHistoricalPrice($input['asset_id'], $input['start_dt'], $input['price']);

        return $this->sendResponse(new PortfolioAssetResource($PortfolioAsset), 'Asset Price saved successfully');
    }

    protected function createChild($data, $source)
    {
        $portfolio = PortfolioExt::where('source', $source)->get()->first();
        $data['portfolio_id'] = $portfolio->id;
        print_r("create: " . json_encode($data) . "\n");
        $ap = PortfolioAsset::create($data);
        return $ap;
    }

    protected function getQuery($source, $asset, $timestamp)
    {
        $portfolio = PortfolioExt::where('source', $source)->get()->first();
        $query = $portfolio->assetsAsOf($timestamp, $asset->id);
        return $query;
    }
}
