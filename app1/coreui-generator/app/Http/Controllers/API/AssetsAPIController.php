<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\API\CreateAssetsAPIRequest;
use App\Http\Requests\API\UpdateAssetsAPIRequest;
use App\Models\Assets;
use App\Repositories\AssetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AssetsResource;
use Response;
use App\Http\Requests\AssetValidationRequest;
use App\Models\AssetChangeLog;

/**
 * Class AssetsController
 * @package App\Http\Controllers\API
 */

class AssetsAPIController extends AppBaseController
{
    /** @var  AssetsRepository */
    private $assetsRepository;

    public function __construct(AssetsRepository $assetsRepo)
    {
        $this->assetsRepository = $assetsRepo;
    }

    /**
     * Display a listing of the Assets.
     * GET|HEAD /assets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $assets = $this->assetsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AssetsResource::collection($assets), 'Assets retrieved successfully');
    }

    /**
     * Store a newly created Assets in storage.
     * POST /assets
     *
     * @param CreateAssetsAPIRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAssetsAPIRequest $request)
    {
        if (isset($request->last_price)) {
            return parent::sendError('You cannot provide last price', [], 400);
        }
        $validated = $request->validated();
        if (!$validated) {
            if ($validated->failedValidation()) {
                return parent::sendError('Validation error.', $validated->messages(), 400);
            }
        }

        $records = Asset::all();
        /**
         *Fetch all assets record and verify if any field record is duplicating
         */
        foreach ($records as $record) {
            if ($record->name == $request->name) {
                return parent::sendError('Asset name already exist', [], 400);
            } else if ($record->type == $request->type) {
                return parent::sendError('Asset type already exist', [], 400);
            } else if ($record->feed_id == $request->feed_id) {
                return parent::sendError('Asset feed_id already exist', [], 400);
            } else if ($record->source_feed == $request->source_feed) {
                return parent::sendError('Asset source feed already exist', [], 400);
            }
        }
        $input = $request->all();

        $assets = $this->assetsRepository->create($input);

        /**
         * Assets Changelog module functionality
         */
        $id = $assetResult->id;
        $field_names = ['name', 'type', 'feed_id', 'source_feed', 'last_price'];
        if ($assetResult->deactivated) {
            array_push($field_names, 'deactivated');
        }
        if ($assetResult->last_update) {
            array_push($field_names, 'last_update');
        }
        if ($assetResult->last_price_update) {
            array_push($field_names, 'last_price_update');
        }
        array_push($field_names, 'created');

        /*
        *save record in changelog
        */
        $changeLog          = new AssetChangeLog();
        $json_field_names   = json_encode($field_names);
        $field_content_data = array();
        foreach ($request->all() as $request) {
            array_push($field_content_data, $request);
        }
        $json_field_content     = json_encode($field_content_data);
        $changeLog->action      = 'add';
        $changeLog->asset_id    = $id;
        $changeLog->field       = $json_field_names;
        $changeLog->content     = $json_field_content;
        $changeLog->datetime    = date("Y-m-d H:i:s");
        $changeLog->save();

        if ($assetResult) {
            return $this->sendResponse(new AssetsResource($assets), 'Assets saved successfully');
//             return parent::sendResponse($assetResult, "Asset record created successfully", 200);
        }
    }

    /**
     * Display the specified Assets.
     * GET|HEAD /assets/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Assets $assets */
        $assets = $this->assetsRepository->find($id);

        if (empty($assets)) {
            return $this->sendError('Assets not found');
        }

        return $this->sendResponse(new AssetsResource($assets), 'Assets retrieved successfully');
    }

    /**
     * Update the specified Assets in storage.
     * PUT/PATCH /assets/{id}
     *
     * @param int $id
     * @param UpdateAssetsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssetsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Assets $assets */
        $assets = $this->assetsRepository->find($id);

        if (empty($assets)) {
            return $this->sendError('Assets not found');
        }

        $assets = $this->assetsRepository->update($input, $id);

        return $this->sendResponse(new AssetsResource($assets), 'Assets updated successfully');
    }

    /**
     * Remove the specified Assets from storage.
     * DELETE /assets/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Assets $assets */
        $assets = $this->assetsRepository->find($id);

        if (empty($assets)) {
            return $this->sendError('Assets not found');
        }

        $assets->delete();

        return $this->sendSuccess('Assets deleted successfully');
    }
}
