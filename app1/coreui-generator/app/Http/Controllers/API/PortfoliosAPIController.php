<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePortfoliosAPIRequest;
use App\Http\Requests\API\UpdatePortfoliosAPIRequest;
use App\Models\Portfolios;
use App\Models\PortfolioAssets;
use App\Repositories\PortfoliosRepository;
use App\Repositories\PortfolioAssetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PortfoliosResource;
use App\Http\Resources\PortfolioAssetsResource;
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

        $portfolioAssetsRepo = \App::make(PortfolioAssetsRepository::class);
        $portfolioAssets = $portfolioAssetsRepo->all(['portfolio_id' => $id]);

        $rss = new PortfoliosResource($portfolios);
        $arr = $rss->toArray(NULL);
        // var_dump($arr);
        PortfolioAssetsResource::collection($portfolioAssets);
        $arr['assets'] = PortfolioAssetsResource::collection($portfolioAssets);
        // $pa = new PortfolioAssetsResource($portfolioAssets);
        // $arr['assets'] = $pa->toArray(NULL);
        
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
