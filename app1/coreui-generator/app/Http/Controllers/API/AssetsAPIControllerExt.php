<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAssetsAPIRequest;
use App\Http\Requests\API\UpdateAssetsAPIRequest;
use App\Models\AssetsExt;
use App\Repositories\AssetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AssetsAPIController;
use App\Http\Resources\AssetPricesResource;
use Response;

/**
 * Class AssetsAPIControllerExt
 * @package App\Http\Controllers\API
 */

class AssetsAPIControllerExt extends AssetsAPIController
{
    public function __construct(AssetsRepository $assetsRepo)
    {
        parent::__construct($assetsRepo);
    }

    public function store2(CreateAssetsAPIRequest $request)
    {
        // var_dump(Assets::factory()->make()->toArray());

        if (isset($request->last_price)) {
            return $this->sendError('You cannot provide last price', [], 400);
        }
        // $validated = $request->validated();
        // if (!$validated && $validated->failedValidation()) {
        //     return $this->sendError('Validation error.', $validated->messages(), 400);
        // }
        $records = $this->assetsRepository->all();

        /**
         *Fetch all assets records and verify if any field record is duplicating
         */
        foreach ($records as $record) {
            if ($record->name == $request->name) {
                return $this->sendError('Asset name already exist', [], 400);
            } else if ($record->type == $request->type) {
                return $this->sendError('Asset type already exist', [], 400);
            } else if ($record->feed_id == $request->feed_id) {
                return $this->sendError('Asset feed_id already exist', [], 400);
            } else if ($record->source_feed == $request->source_feed) {
                return $this->sendError('Asset source feed already exist', [], 400);
            }
        }
        
        $input = $request->all();

        $assets = $this->assetsRepository->create($input);
        // $assetResult = Asset::create([
        //     'name'          => $request->name,
        //     'type'          => $request->type,
        //     'feed_id'       => $request->feed_id,
        //     'source_feed'   => $request->source_feed,
        //     'last_price'    => '0',
        //     'created'       => date("Y-m-d H:i:s")
        // ]);

        /**
         * Assets Changelog module functionality
         */
        $id = $assets->id;
        $field_names = ['name', 'type', 'feed_id', 'source_feed', 'last_price'];
        // if ($assets->deactivated) {
        //     array_push($field_names, 'deactivated');
        // }
        // if ($assets->last_update) {
        //     array_push($field_names, 'last_update');
        // }
        // if ($assets->last_price_update) {
        //     array_push($field_names, 'last_price_update');
        // }
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

        if ($assets) {
            return $this->sendResponse(new AssetsResource($assets), 'Assets saved successfully');
            // return $this->sendResponse($assetResult, "Asset record created successfully", 200);
        }
    }
}
