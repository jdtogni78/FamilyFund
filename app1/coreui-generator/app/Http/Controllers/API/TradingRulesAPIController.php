<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTradingRulesAPIRequest;
use App\Http\Requests\API\UpdateTradingRulesAPIRequest;
use App\Models\TradingRules;
use App\Repositories\TradingRulesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TradingRulesResource;
use Response;

/**
 * Class TradingRulesController
 * @package App\Http\Controllers\API
 */

class TradingRulesAPIController extends AppBaseController
{
    /** @var  TradingRulesRepository */
    private $tradingRulesRepository;

    public function __construct(TradingRulesRepository $tradingRulesRepo)
    {
        $this->tradingRulesRepository = $tradingRulesRepo;
    }

    /**
     * Display a listing of the TradingRules.
     * GET|HEAD /tradingRules
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tradingRules = $this->tradingRulesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TradingRulesResource::collection($tradingRules), 'Trading Rules retrieved successfully');
    }

    /**
     * Store a newly created TradingRules in storage.
     * POST /tradingRules
     *
     * @param CreateTradingRulesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTradingRulesAPIRequest $request)
    {
        $input = $request->all();

        $tradingRules = $this->tradingRulesRepository->create($input);

        return $this->sendResponse(new TradingRulesResource($tradingRules), 'Trading Rules saved successfully');
    }

    /**
     * Display the specified TradingRules.
     * GET|HEAD /tradingRules/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TradingRules $tradingRules */
        $tradingRules = $this->tradingRulesRepository->find($id);

        if (empty($tradingRules)) {
            return $this->sendError('Trading Rules not found');
        }

        return $this->sendResponse(new TradingRulesResource($tradingRules), 'Trading Rules retrieved successfully');
    }

    /**
     * Update the specified TradingRules in storage.
     * PUT/PATCH /tradingRules/{id}
     *
     * @param int $id
     * @param UpdateTradingRulesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTradingRulesAPIRequest $request)
    {
        $input = $request->all();

        /** @var TradingRules $tradingRules */
        $tradingRules = $this->tradingRulesRepository->find($id);

        if (empty($tradingRules)) {
            return $this->sendError('Trading Rules not found');
        }

        $tradingRules = $this->tradingRulesRepository->update($input, $id);

        return $this->sendResponse(new TradingRulesResource($tradingRules), 'TradingRules updated successfully');
    }

    /**
     * Remove the specified TradingRules from storage.
     * DELETE /tradingRules/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TradingRules $tradingRules */
        $tradingRules = $this->tradingRulesRepository->find($id);

        if (empty($tradingRules)) {
            return $this->sendError('Trading Rules not found');
        }

        $tradingRules->delete();

        return $this->sendSuccess('Trading Rules deleted successfully');
    }
}
