<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAssetPricesAPIRequest;
use App\Http\Requests\API\UpdateAssetPricesAPIRequest;
use App\Repositories\AssetPricesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\AssetPrices;
use App\Models\Assets;
use App\Http\Resources\AssetPricesResource;
use Response;

/**
 * Class AssetPricesController
 * @package App\Http\Controllers\API
 */

class AssetPricesAPIController extends AppBaseController
{
    /** @var  AssetPricesRepository */
    private $assetPricesRepository;

    public function __construct(AssetPricesRepository $assetPricesRepo)
    {
        $this->assetPricesRepository = $assetPricesRepo;
    }

    /**
     * Display a listing of the AssetPrices.
     * GET|HEAD /assetPrices
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $assetPrices = $this->assetPricesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AssetPricesResource::collection($assetPrices), 'Asset Prices retrieved successfully');
    }

    /**
     * Store a newly created AssetPrices in storage.
     * POST /assetPrices
     *
     * @param CreateAssetPricesAPIRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAssetPricesAPIRequest $request)
    {
        $input = $request->all();

        $assetPrices = $this->assetPricesRepository->create($input);

        return $this->sendResponse(new AssetPricesResource($assetPrices), 'Asset Price saved successfully');
    }

    /**
     * Display the specified AssetPrices.
     * GET|HEAD /assetPrices/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var AssetPrices $assetPrices */
        $assetPrices = $this->assetPricesRepository->find($id);

        if (empty($assetPrices)) {
            return $this->sendError('Asset Prices not found');
        }

        return $this->sendResponse(new AssetPricesResource($assetPrices), 'Asset Prices retrieved successfully');
    }

    /**
     * Update the specified AssetPrices in storage.
     * PUT/PATCH /assetPrices/{id}
     *
     * @param int $id
     * @param UpdateAssetPricesAPIRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateAssetPricesAPIRequest $request)
    {
        $input = $request->all();

        /** @var AssetPrices $assetPrices */
        $assetPrices = $this->assetPricesRepository->find($id);

        if (empty($assetPrices)) {
            return $this->sendError('Asset Prices not found');
        }

        $assetPrices = $this->assetPricesRepository->update($input, $id);

        return $this->sendResponse(new AssetPricesResource($assetPrices), 'AssetPrices updated successfully');
    }

    /**
     * Remove the specified AssetPrices from storage.
     * DELETE /assetPrices/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AssetPrices $assetPrices */
        $assetPrices = $this->assetPricesRepository->find($id);

        if (empty($assetPrices)) {
            return $this->sendError('Asset Prices not found');
        }

        $assetPrices->delete();

        return $this->sendSuccess('Asset Prices deleted successfully');
    }
}
