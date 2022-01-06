<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountMatchingRulesAPIRequest;
use App\Http\Requests\API\UpdateAccountMatchingRulesAPIRequest;
use App\Models\AccountMatchingRules;
use App\Repositories\AccountMatchingRulesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AccountMatchingRulesResource;
use Response;

/**
 * Class AccountMatchingRulesController
 * @package App\Http\Controllers\API
 */

class AccountMatchingRulesAPIController extends AppBaseController
{
    /** @var  AccountMatchingRulesRepository */
    private $accountMatchingRulesRepository;

    public function __construct(AccountMatchingRulesRepository $accountMatchingRulesRepo)
    {
        $this->accountMatchingRulesRepository = $accountMatchingRulesRepo;
    }

    /**
     * Display a listing of the AccountMatchingRules.
     * GET|HEAD /accountMatchingRules
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $accountMatchingRules = $this->accountMatchingRulesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AccountMatchingRulesResource::collection($accountMatchingRules), 'Account Matching Rules retrieved successfully');
    }

    /**
     * Store a newly created AccountMatchingRules in storage.
     * POST /accountMatchingRules
     *
     * @param CreateAccountMatchingRulesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountMatchingRulesAPIRequest $request)
    {
        $input = $request->all();

        $accountMatchingRules = $this->accountMatchingRulesRepository->create($input);

        return $this->sendResponse(new AccountMatchingRulesResource($accountMatchingRules), 'Account Matching Rules saved successfully');
    }

    /**
     * Display the specified AccountMatchingRules.
     * GET|HEAD /accountMatchingRules/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AccountMatchingRules $accountMatchingRules */
        $accountMatchingRules = $this->accountMatchingRulesRepository->find($id);

        if (empty($accountMatchingRules)) {
            return $this->sendError('Account Matching Rules not found');
        }

        return $this->sendResponse(new AccountMatchingRulesResource($accountMatchingRules), 'Account Matching Rules retrieved successfully');
    }

    /**
     * Update the specified AccountMatchingRules in storage.
     * PUT/PATCH /accountMatchingRules/{id}
     *
     * @param int $id
     * @param UpdateAccountMatchingRulesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountMatchingRulesAPIRequest $request)
    {
        $input = $request->all();

        /** @var AccountMatchingRules $accountMatchingRules */
        $accountMatchingRules = $this->accountMatchingRulesRepository->find($id);

        if (empty($accountMatchingRules)) {
            return $this->sendError('Account Matching Rules not found');
        }

        $accountMatchingRules = $this->accountMatchingRulesRepository->update($input, $id);

        return $this->sendResponse(new AccountMatchingRulesResource($accountMatchingRules), 'AccountMatchingRules updated successfully');
    }

    /**
     * Remove the specified AccountMatchingRules from storage.
     * DELETE /accountMatchingRules/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AccountMatchingRules $accountMatchingRules */
        $accountMatchingRules = $this->accountMatchingRulesRepository->find($id);

        if (empty($accountMatchingRules)) {
            return $this->sendError('Account Matching Rules not found');
        }

        $accountMatchingRules->delete();

        return $this->sendSuccess('Account Matching Rules deleted successfully');
    }
}
