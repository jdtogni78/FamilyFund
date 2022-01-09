<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\AssetPricesAPIControllerExt;
use Illuminate\Http\Request;
use App\Models\AssetPrices;
use App\Repositories\AssetPricesRepository;
use App\Http\Requests\API\CreateAssetPricesAPIRequest;
use App\Models\Asset;

class AssetPricesAPIControllerExt extends AssetPricesAPIController
{
    public function __construct(AssetPricesRepository $assetPricesRepo)
    {
        parent::__construct($assetPricesRepo);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAssetPricesAPIRequest $request)
    {
        // TODO: end date previous price if needed
        // find record that overlaps provided start date
        // make old record end with provided start date
        // make current record have old record end date

        return parent::store($request);
        // $validated = $request->validated();
        // if (!$validated && $validated->failedValidation()) {
        //     return parent::sendError('Validation Error.', $validated->messages(), 400);
        // }

        // $assetResult = AssetPrices::create([
        //     'feed_id'       => $request->feed_id,
        //     'source_feed'   => $request->source_feed,
        //     'price'         => $request->price,
        //     'datetime'      => date("Y-m-d H:i:s")
        // ]);

        // $updateAssetRecord = Asset::where('feed_id', $request->feed_id)->first();

        // $updateAssetRecord->update([
        //     'last_price'        => $request->price,
        //     'last_price_update' => $assetResult->created_at
        // ]);
        // if ($assetResult) {
        //     return parent::sendResponse($assetResult, "Asset price history record created successfully", 200);
        // }
    }
}