<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountTradingRuleAPIRequest;
use App\Http\Requests\API\UpdateAccountTradingRuleAPIRequest;
use App\Models\AccountTradingRule;
use App\Repositories\AccountTradingRuleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AccountTradingRuleResource;
use Response;

/**
 * Class AccountTradingRuleController
 * @package App\Http\Controllers\API
 */

class AccountTradingRuleAPIController extends AppBaseController
{
    /** @var  AccountTradingRuleRepository */
    protected $accountTradingRuleRepository;

    public function __construct(AccountTradingRuleRepository $accountTradingRuleRepo)
    {
        $this->accountTradingRuleRepository = $accountTradingRuleRepo;
    }

    /**
     * Display a listing of the AccountTradingRule.
     * GET|HEAD /accountTradingRules
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $accountTradingRules = $this->accountTradingRuleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AccountTradingRuleResource::collection($accountTradingRules), 'Account Trading Rules retrieved successfully');
    }

    /**
     * Store a newly created AccountTradingRule in storage.
     * POST /accountTradingRules
     *
     * @param CreateAccountTradingRuleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountTradingRuleAPIRequest $request)
    {
        $input = $request->all();

        $accountTradingRule = $this->accountTradingRuleRepository->create($input);

        return $this->sendResponse(new AccountTradingRuleResource($accountTradingRule), 'Account Trading Rule saved successfully');
    }

    /**
     * Display the specified AccountTradingRule.
     * GET|HEAD /accountTradingRules/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AccountTradingRule $accountTradingRule */
        $accountTradingRule = $this->accountTradingRuleRepository->find($id);

        if (empty($accountTradingRule)) {
            return $this->sendError('Account Trading Rule not found');
        }

        return $this->sendResponse(new AccountTradingRuleResource($accountTradingRule), 'Account Trading Rule retrieved successfully');
    }

    /**
     * Update the specified AccountTradingRule in storage.
     * PUT/PATCH /accountTradingRules/{id}
     *
     * @param int $id
     * @param UpdateAccountTradingRuleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountTradingRuleAPIRequest $request)
    {
        $input = $request->all();

        /** @var AccountTradingRule $accountTradingRule */
        $accountTradingRule = $this->accountTradingRuleRepository->find($id);

        if (empty($accountTradingRule)) {
            return $this->sendError('Account Trading Rule not found');
        }

        $accountTradingRule = $this->accountTradingRuleRepository->update($input, $id);

        return $this->sendResponse(new AccountTradingRuleResource($accountTradingRule), 'AccountTradingRule updated successfully');
    }

    /**
     * Remove the specified AccountTradingRule from storage.
     * DELETE /accountTradingRules/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AccountTradingRule $accountTradingRule */
        $accountTradingRule = $this->accountTradingRuleRepository->find($id);

        if (empty($accountTradingRule)) {
            return $this->sendError('Account Trading Rule not found');
        }

        $accountTradingRule->delete();

        return $this->sendSuccess('Account Trading Rule deleted successfully');
    }
}
