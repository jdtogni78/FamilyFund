<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountBalancesAPIRequest;
use App\Http\Requests\API\UpdateAccountBalancesAPIRequest;
use App\Models\AccountBalances;
use App\Repositories\AccountBalancesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AccountBalancesResource;
use Response;

/**
 * Class AccountBalancesController
 * @package App\Http\Controllers\API
 */

class AccountBalancesAPIController extends AppBaseController
{
    /** @var  AccountBalancesRepository */
    private $accountBalancesRepository;

    public function __construct(AccountBalancesRepository $accountBalancesRepo)
    {
        $this->accountBalancesRepository = $accountBalancesRepo;
    }

    /**
     * Display a listing of the AccountBalances.
     * GET|HEAD /accountBalances
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $accountBalances = $this->accountBalancesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AccountBalancesResource::collection($accountBalances), 'Account Balances retrieved successfully');
    }

    /**
     * Store a newly created AccountBalances in storage.
     * POST /accountBalances
     *
     * @param CreateAccountBalancesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountBalancesAPIRequest $request)
    {
        $input = $request->all();

        $accountBalances = $this->accountBalancesRepository->create($input);

        return $this->sendResponse(new AccountBalancesResource($accountBalances), 'Account Balances saved successfully');
    }

    /**
     * Display the specified AccountBalances.
     * GET|HEAD /accountBalances/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AccountBalances $accountBalances */
        $accountBalances = $this->accountBalancesRepository->find($id);

        if (empty($accountBalances)) {
            return $this->sendError('Account Balances not found');
        }

        return $this->sendResponse(new AccountBalancesResource($accountBalances), 'Account Balances retrieved successfully');
    }

    /**
     * Update the specified AccountBalances in storage.
     * PUT/PATCH /accountBalances/{id}
     *
     * @param int $id
     * @param UpdateAccountBalancesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountBalancesAPIRequest $request)
    {
        $input = $request->all();

        /** @var AccountBalances $accountBalances */
        $accountBalances = $this->accountBalancesRepository->find($id);

        if (empty($accountBalances)) {
            return $this->sendError('Account Balances not found');
        }

        $accountBalances = $this->accountBalancesRepository->update($input, $id);

        return $this->sendResponse(new AccountBalancesResource($accountBalances), 'AccountBalances updated successfully');
    }

    /**
     * Remove the specified AccountBalances from storage.
     * DELETE /accountBalances/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AccountBalances $accountBalances */
        $accountBalances = $this->accountBalancesRepository->find($id);

        if (empty($accountBalances)) {
            return $this->sendError('Account Balances not found');
        }

        $accountBalances->delete();

        return $this->sendSuccess('Account Balances deleted successfully');
    }
}
