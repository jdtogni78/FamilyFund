<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountsAPIRequest;
use App\Http\Requests\API\UpdateAccountsAPIRequest;
use App\Models\Accounts;
use App\Repositories\AccountsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AccountsResource;
use Response;

/**
 * Class AccountsController
 * @package App\Http\Controllers\API
 */

class AccountsAPIController extends AppBaseController
{
    /** @var  AccountsRepository */
    private $accountsRepository;

    public function __construct(AccountsRepository $accountsRepo)
    {
        $this->accountsRepository = $accountsRepo;
    }

    /**
     * Display a listing of the Accounts.
     * GET|HEAD /accounts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $accounts = $this->accountsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AccountsResource::collection($accounts), 'Accounts retrieved successfully');
    }

    /**
     * Store a newly created Accounts in storage.
     * POST /accounts
     *
     * @param CreateAccountsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountsAPIRequest $request)
    {
        $input = $request->all();

        $accounts = $this->accountsRepository->create($input);

        return $this->sendResponse(new AccountsResource($accounts), 'Accounts saved successfully');
    }

    /**
     * Display the specified Accounts.
     * GET|HEAD /accounts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Accounts $accounts */
        $accounts = $this->accountsRepository->find($id);

        if (empty($accounts)) {
            return $this->sendError('Accounts not found');
        }

        return $this->sendResponse(new AccountsResource($accounts), 'Accounts retrieved successfully');
    }

    /**
     * Update the specified Accounts in storage.
     * PUT/PATCH /accounts/{id}
     *
     * @param int $id
     * @param UpdateAccountsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Accounts $accounts */
        $accounts = $this->accountsRepository->find($id);

        if (empty($accounts)) {
            return $this->sendError('Accounts not found');
        }

        $accounts = $this->accountsRepository->update($input, $id);

        return $this->sendResponse(new AccountsResource($accounts), 'Accounts updated successfully');
    }

    /**
     * Remove the specified Accounts from storage.
     * DELETE /accounts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Accounts $accounts */
        $accounts = $this->accountsRepository->find($id);

        if (empty($accounts)) {
            return $this->sendError('Accounts not found');
        }

        $accounts->delete();

        return $this->sendSuccess('Accounts deleted successfully');
    }
}
