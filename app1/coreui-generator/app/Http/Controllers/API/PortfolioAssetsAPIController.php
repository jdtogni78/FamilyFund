<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePortfolioAssetsAPIRequest;
use App\Http\Requests\API\UpdatePortfolioAssetsAPIRequest;
use App\Models\PortfolioAssets;
use App\Repositories\PortfolioAssetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PortfolioAssetsResource;
use Response;

/**
 * Class PortfolioAssetsController
 * @package App\Http\Controllers\API
 */

class PortfolioAssetsAPIController extends AppBaseController
{
    /** @var  PortfolioAssetsRepository */
    private $portfolioAssetsRepository;

    public function __construct(PortfolioAssetsRepository $portfolioAssetsRepo)
    {
        $this->portfolioAssetsRepository = $portfolioAssetsRepo;
    }

    /**
     * Display a listing of the PortfolioAssets.
     * GET|HEAD /portfolioAssets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $portfolioAssets = $this->portfolioAssetsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PortfolioAssetsResource::collection($portfolioAssets), 'Portfolio Assets retrieved successfully');
    }

    /**
     * Store a newly created PortfolioAssets in storage.
     * POST /portfolioAssets
     *
     * @param CreatePortfolioAssetsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePortfolioAssetsAPIRequest $request)
    {
        $input = $request->all();

        $portfolioAssets = $this->portfolioAssetsRepository->create($input);

        return $this->sendResponse(new PortfolioAssetsResource($portfolioAssets), 'Portfolio Assets saved successfully');
    }

    /**
     * Display the specified PortfolioAssets.
     * GET|HEAD /portfolioAssets/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PortfolioAssets $portfolioAssets */
        $portfolioAssets = $this->portfolioAssetsRepository->find($id);

        if (empty($portfolioAssets)) {
            return $this->sendError('Portfolio Assets not found');
        }

        return $this->sendResponse(new PortfolioAssetsResource($portfolioAssets), 'Portfolio Assets retrieved successfully');
    }

    /**
     * Update the specified PortfolioAssets in storage.
     * PUT/PATCH /portfolioAssets/{id}
     *
     * @param int $id
     * @param UpdatePortfolioAssetsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePortfolioAssetsAPIRequest $request)
    {
        $input = $request->all();

        /** @var PortfolioAssets $portfolioAssets */
        $portfolioAssets = $this->portfolioAssetsRepository->find($id);

        if (empty($portfolioAssets)) {
            return $this->sendError('Portfolio Assets not found');
        }

        $portfolioAssets = $this->portfolioAssetsRepository->update($input, $id);

        return $this->sendResponse(new PortfolioAssetsResource($portfolioAssets), 'PortfolioAssets updated successfully');
    }

    /**
     * Remove the specified PortfolioAssets from storage.
     * DELETE /portfolioAssets/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PortfolioAssets $portfolioAssets */
        $portfolioAssets = $this->portfolioAssetsRepository->find($id);

        if (empty($portfolioAssets)) {
            return $this->sendError('Portfolio Assets not found');
        }

        $portfolioAssets->delete();

        return $this->sendSuccess('Portfolio Assets deleted successfully');
    }
}
