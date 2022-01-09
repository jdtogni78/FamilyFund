<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAssetsAPIRequest;
use App\Http\Requests\API\UpdateAssetsAPIRequest;
use App\Models\Assets;
use App\Repositories\AssetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AssetsResource;
use Response;

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
     * @return Response
     */
    public function store(CreateAssetsAPIRequest $request)
    {
        $input = $request->all();

        $assets = $this->assetsRepository->create($input);

        return $this->sendResponse(new AssetsResource($assets), 'Assets saved successfully');
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
        // var_dump(Assets::factory()->make()->toArray());
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
