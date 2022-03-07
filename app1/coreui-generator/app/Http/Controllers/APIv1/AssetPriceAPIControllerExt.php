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
        $input = $request->all();
        $symbols = $request->collect('symbols')->toArray();
        $timestamp = $input['timestamp'];
        $source = $input['source'];

        foreach ($symbols as $symbol) {
            $symbol['source'] = $source;
            $input = array_intersect_key($symbol, array_flip((new AssetExt())->fillable));
            $asset = AssetExt::firstOrCreate($input);
            $this->insertHistoricalPrice($asset->id, $timestamp, $symbol['price']);
        }
        return $this->sendResponse([], 'Bulk price update successful!');
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

    protected function createAP($asset, mixed $newPrice, mixed $timestamp, $endDt)
    {
        $data = [
            'asset_id' => $asset->id,
            'price'    => $newPrice,
            'start_dt' => $timestamp,
        ];
        if ($endDt) $data['end_dt'] = $endDt;
        $ap = AssetPrice::create($data);
        return $ap;
    }

    protected function insertHistoricalPrice($assetId, $timestamp, $newPrice): AssetPrice
    {
        $asset = AssetExt::find($assetId);
        if ($asset == null) {
            throw new ValidationException("Invalid asset provided: ". $assetId);
        }
        $apQuery = $asset->pricesAsOf($timestamp);

        $ret = null;
        $create = true;
        $newEnd = null;
        if (!$apQuery->isEmpty()) {
            $create = false;
            foreach ($apQuery as $ap) {
                // price changed, lets end & create new
                if ($ap->price != $newPrice) {
                    $newEnd = $ap->end_dt; // in case thats not the last record
                    $ap->end_dt = $timestamp;
                    $ap->save();
                    $create = true;
                } else {
                    $ret = $ap;
                }
            }
        }
        if ($create) {
            $ret = $this->createAP($asset, $newPrice, $timestamp, $newEnd);
        }
        return $ret;
    }

}
