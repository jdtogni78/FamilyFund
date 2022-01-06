<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountBalancesRequest;
use App\Http\Requests\UpdateAccountBalancesRequest;
use App\Repositories\AccountBalancesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AccountBalancesController extends AppBaseController
{
    /** @var  AccountBalancesRepository */
    private $accountBalancesRepository;

    public function __construct(AccountBalancesRepository $accountBalancesRepo)
    {
        $this->accountBalancesRepository = $accountBalancesRepo;
    }

    /**
     * Display a listing of the AccountBalances.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $accountBalances = $this->accountBalancesRepository->all();

        return view('account_balances.index')
            ->with('accountBalances', $accountBalances);
    }

    /**
     * Show the form for creating a new AccountBalances.
     *
     * @return Response
     */
    public function create()
    {
        return view('account_balances.create');
    }

    /**
     * Store a newly created AccountBalances in storage.
     *
     * @param CreateAccountBalancesRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountBalancesRequest $request)
    {
        $input = $request->all();

        $accountBalances = $this->accountBalancesRepository->create($input);

        Flash::success('Account Balances saved successfully.');

        return redirect(route('accountBalances.index'));
    }

    /**
     * Display the specified AccountBalances.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accountBalances = $this->accountBalancesRepository->find($id);

        if (empty($accountBalances)) {
            Flash::error('Account Balances not found');

            return redirect(route('accountBalances.index'));
        }

        return view('account_balances.show')->with('accountBalances', $accountBalances);
    }

    /**
     * Show the form for editing the specified AccountBalances.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accountBalances = $this->accountBalancesRepository->find($id);

        if (empty($accountBalances)) {
            Flash::error('Account Balances not found');

            return redirect(route('accountBalances.index'));
        }

        return view('account_balances.edit')->with('accountBalances', $accountBalances);
    }

    /**
     * Update the specified AccountBalances in storage.
     *
     * @param int $id
     * @param UpdateAccountBalancesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountBalancesRequest $request)
    {
        $accountBalances = $this->accountBalancesRepository->find($id);

        if (empty($accountBalances)) {
            Flash::error('Account Balances not found');

            return redirect(route('accountBalances.index'));
        }

        $accountBalances = $this->accountBalancesRepository->update($request->all(), $id);

        Flash::success('Account Balances updated successfully.');

        return redirect(route('accountBalances.index'));
    }

    /**
     * Remove the specified AccountBalances from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accountBalances = $this->accountBalancesRepository->find($id);

        if (empty($accountBalances)) {
            Flash::error('Account Balances not found');

            return redirect(route('accountBalances.index'));
        }

        $this->accountBalancesRepository->delete($id);

        Flash::success('Account Balances deleted successfully.');

        return redirect(route('accountBalances.index'));
    }
}
