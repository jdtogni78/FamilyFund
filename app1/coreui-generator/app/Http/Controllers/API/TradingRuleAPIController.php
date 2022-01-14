<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTradingRuleAPIRequest;
use App\Http\Requests\API\UpdateTradingRuleAPIRequest;
use App\Models\TradingRule;
use App\Repositories\TradingRuleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TradingRuleResource;
use Response;

/**
 * Class TradingRuleController
 * @package App\Http\Controllers\API
 */

class TradingRuleAPIController extends AppBaseController
{
    /** @var  TradingRuleRepository */
    protected $tradingRuleRepository;

    public function __construct(TradingRuleRepository $tradingRuleRepo)
    {
        $this->tradingRuleRepository = $tradingRuleRepo;
    }

    /**
     * Display a listing of the TradingRule.
     * GET|HEAD /tradingRules
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tradingRules = $this->tradingRuleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TradingRuleResource::collection($tradingRules), 'Trading Rules retrieved successfully');
    }

    /**
     * Store a newly created TradingRule in storage.
     * POST /tradingRules
     *
     * @param CreateTradingRuleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTradingRuleAPIRequest $request)
    {
        $input = $request->all();

        $tradingRule = $this->tradingRuleRepository->create($input);

        return $this->sendResponse(new TradingRuleResource($tradingRule), 'Trading Rule saved successfully');
    }

    /**
     * Display the specified TradingRule.
     * GET|HEAD /tradingRules/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TradingRule $tradingRule */
        $tradingRule = $this->tradingRuleRepository->find($id);

        if (empty($tradingRule)) {
            return $this->sendError('Trading Rule not found');
        }

        return $this->sendResponse(new TradingRuleResource($tradingRule), 'Trading Rule retrieved successfully');
    }

    /**
     * Update the specified TradingRule in storage.
     * PUT/PATCH /tradingRules/{id}
     *
     * @param int $id
     * @param UpdateTradingRuleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTradingRuleAPIRequest $request)
    {
        $input = $request->all();

        /** @var TradingRule $tradingRule */
        $tradingRule = $this->tradingRuleRepository->find($id);

        if (empty($tradingRule)) {
            return $this->sendError('Trading Rule not found');
        }

        $tradingRule = $this->tradingRuleRepository->update($input, $id);

        return $this->sendResponse(new TradingRuleResource($tradingRule), 'TradingRule updated successfully');
    }

    /**
     * Remove the specified TradingRule from storage.
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
        /** @var TradingRule $tradingRule */
        $tradingRule = $this->tradingRuleRepository->find($id);

        if (empty($tradingRule)) {
            return $this->sendError('Trading Rule not found');
        }

        $tradingRule->delete();

        return $this->sendSuccess('Trading Rule deleted successfully');
    }
}
