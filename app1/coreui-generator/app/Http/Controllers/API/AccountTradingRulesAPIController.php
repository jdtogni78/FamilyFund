<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountTradingRulesAPIRequest;
use App\Http\Requests\API\UpdateAccountTradingRulesAPIRequest;
use App\Models\AccountTradingRules;
use App\Repositories\AccountTradingRulesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AccountTradingRulesResource;
use Response;

/**
 * Class AccountTradingRulesController
 * @package App\Http\Controllers\API
 */

class AccountTradingRulesAPIController extends AppBaseController
{
    /** @var  AccountTradingRulesRepository */
    private $accountTradingRulesRepository;

    public function __construct(AccountTradingRulesRepository $accountTradingRulesRepo)
    {
        $this->accountTradingRulesRepository = $accountTradingRulesRepo;
    }

    /**
     * Display a listing of the AccountTradingRules.
     * GET|HEAD /accountTradingRules
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $accountTradingRules = $this->accountTradingRulesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AccountTradingRulesResource::collection($accountTradingRules), 'Account Trading Rules retrieved successfully');
    }

    /**
     * Store a newly created AccountTradingRules in storage.
     * POST /accountTradingRules
     *
     * @param CreateAccountTradingRulesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountTradingRulesAPIRequest $request)
    {
        $input = $request->all();

        $accountTradingRules = $this->accountTradingRulesRepository->create($input);

        return $this->sendResponse(new AccountTradingRulesResource($accountTradingRules), 'Account Trading Rules saved successfully');
    }

    /**
     * Display the specified AccountTradingRules.
     * GET|HEAD /accountTradingRules/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AccountTradingRules $accountTradingRules */
        $accountTradingRules = $this->accountTradingRulesRepository->find($id);

        if (empty($accountTradingRules)) {
            return $this->sendError('Account Trading Rules not found');
        }

        return $this->sendResponse(new AccountTradingRulesResource($accountTradingRules), 'Account Trading Rules retrieved successfully');
    }

    /**
     * Update the specified AccountTradingRules in storage.
     * PUT/PATCH /accountTradingRules/{id}
     *
     * @param int $id
     * @param UpdateAccountTradingRulesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountTradingRulesAPIRequest $request)
    {
        $input = $request->all();

        /** @var AccountTradingRules $accountTradingRules */
        $accountTradingRules = $this->accountTradingRulesRepository->find($id);

        if (empty($accountTradingRules)) {
            return $this->sendError('Account Trading Rules not found');
        }

        $accountTradingRules = $this->accountTradingRulesRepository->update($input, $id);

        return $this->sendResponse(new AccountTradingRulesResource($accountTradingRules), 'AccountTradingRules updated successfully');
    }

    /**
     * Remove the specified AccountTradingRules from storage.
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
        /** @var AccountTradingRules $accountTradingRules */
        $accountTradingRules = $this->accountTradingRulesRepository->find($id);

        if (empty($accountTradingRules)) {
            return $this->sendError('Account Trading Rules not found');
        }

        $accountTradingRules->delete();

        return $this->sendSuccess('Account Trading Rules deleted successfully');
    }
}
