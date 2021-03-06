<?php

namespace App\Http\Controllers\APIv1;

use App\Http\Controllers\API\AssetPriceAPIController;
use App\Http\Requests\API\CreateAssetPriceAPIRequest;
use App\Http\Requests\API\CreatePriceUpdateAPIRequest;
use App\Models\AssetExt;
use App\Models\AssetPrice;
use App\Models\AssetPrices;
use App\Models\PriceUpdate;
use App\Repositories\AssetPriceRepository;
use Nette\Schema\ValidationException;
use function PHPUnit\Framework\isEmpty;

class AssetPriceAPIControllerExt extends AssetPriceAPIController
{
    use BulkStore;

    public function __construct(AssetPriceRepository $assetPricesRepo)
    {
        parent::__construct($assetPricesRepo);
    }

    /**
     * Store a newly created AssetPriceCollection in storage.
     * POST /assetPriceBulkUpdate
     *
     * @param CreatePriceUpdateAPIRequest $request
     *
     * @return Response
     */
    public function bulkStore(CreatePriceUpdateAPIRequest $request)
    {
        return $this->genericBulkStore($request, 'price');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAssetPriceAPIRequest $request)
    {
        $input = $request->all();

        $assetPrice = $this->insertHistoricalPrice($input['asset_id'], $input['start_dt'], $input['price']);

        return $this->sendResponse(new AssetPriceResource($assetPrice), 'Asset Price saved successfully');
    }

    protected function createChild($data, $source)
    {
        $ap = AssetPrice::create($data);
        if ($data['price'] != $ap->price) {
            $this->warn("Price was adjusted from ".$data['price']." to ".$ap->price);
        }
        return $ap;
    }

    protected function getQuery($source, $asset, $timestamp)
    {
        $query = $asset->pricesAsOf($timestamp);
        return $query;
    }
}
