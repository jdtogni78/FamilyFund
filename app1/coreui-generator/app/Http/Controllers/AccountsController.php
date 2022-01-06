<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountsRequest;
use App\Http\Requests\UpdateAccountsRequest;
use App\Repositories\AccountsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AccountsController extends AppBaseController
{
    /** @var  AccountsRepository */
    private $accountsRepository;

    public function __construct(AccountsRepository $accountsRepo)
    {
        $this->accountsRepository = $accountsRepo;
    }

    /**
     * Display a listing of the Accounts.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $accounts = $this->accountsRepository->all();

        return view('accounts.index')
            ->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new Accounts.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created Accounts in storage.
     *
     * @param CreateAccountsRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountsRequest $request)
    {
        $input = $request->all();

        $accounts = $this->accountsRepository->create($input);

        Flash::success('Accounts saved successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified Accounts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accounts = $this->accountsRepository->find($id);

        if (empty($accounts)) {
            Flash::error('Accounts not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.show')->with('accounts', $accounts);
    }

    /**
     * Show the form for editing the specified Accounts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accounts = $this->accountsRepository->find($id);

        if (empty($accounts)) {
            Flash::error('Accounts not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.edit')->with('accounts', $accounts);
    }

    /**
     * Update the specified Accounts in storage.
     *
     * @param int $id
     * @param UpdateAccountsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountsRequest $request)
    {
        $accounts = $this->accountsRepository->find($id);

        if (empty($accounts)) {
            Flash::error('Accounts not found');

            return redirect(route('accounts.index'));
        }

        $accounts = $this->accountsRepository->update($request->all(), $id);

        Flash::success('Accounts updated successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified Accounts from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accounts = $this->accountsRepository->find($id);

        if (empty($accounts)) {
            Flash::error('Accounts not found');

            return redirect(route('accounts.index'));
        }

        $this->accountsRepository->delete($id);

        Flash::success('Accounts deleted successfully.');

        return redirect(route('accounts.index'));
    }
}
