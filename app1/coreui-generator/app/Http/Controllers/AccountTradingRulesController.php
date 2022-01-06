<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountTradingRulesRequest;
use App\Http\Requests\UpdateAccountTradingRulesRequest;
use App\Repositories\AccountTradingRulesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AccountTradingRulesController extends AppBaseController
{
    /** @var  AccountTradingRulesRepository */
    private $accountTradingRulesRepository;

    public function __construct(AccountTradingRulesRepository $accountTradingRulesRepo)
    {
        $this->accountTradingRulesRepository = $accountTradingRulesRepo;
    }

    /**
     * Display a listing of the AccountTradingRules.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $accountTradingRules = $this->accountTradingRulesRepository->all();

        return view('account_trading_rules.index')
            ->with('accountTradingRules', $accountTradingRules);
    }

    /**
     * Show the form for creating a new AccountTradingRules.
     *
     * @return Response
     */
    public function create()
    {
        return view('account_trading_rules.create');
    }

    /**
     * Store a newly created AccountTradingRules in storage.
     *
     * @param CreateAccountTradingRulesRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountTradingRulesRequest $request)
    {
        $input = $request->all();

        $accountTradingRules = $this->accountTradingRulesRepository->create($input);

        Flash::success('Account Trading Rules saved successfully.');

        return redirect(route('accountTradingRules.index'));
    }

    /**
     * Display the specified AccountTradingRules.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accountTradingRules = $this->accountTradingRulesRepository->find($id);

        if (empty($accountTradingRules)) {
            Flash::error('Account Trading Rules not found');

            return redirect(route('accountTradingRules.index'));
        }

        return view('account_trading_rules.show')->with('accountTradingRules', $accountTradingRules);
    }

    /**
     * Show the form for editing the specified AccountTradingRules.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accountTradingRules = $this->accountTradingRulesRepository->find($id);

        if (empty($accountTradingRules)) {
            Flash::error('Account Trading Rules not found');

            return redirect(route('accountTradingRules.index'));
        }

        return view('account_trading_rules.edit')->with('accountTradingRules', $accountTradingRules);
    }

    /**
     * Update the specified AccountTradingRules in storage.
     *
     * @param int $id
     * @param UpdateAccountTradingRulesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountTradingRulesRequest $request)
    {
        $accountTradingRules = $this->accountTradingRulesRepository->find($id);

        if (empty($accountTradingRules)) {
            Flash::error('Account Trading Rules not found');

            return redirect(route('accountTradingRules.index'));
        }

        $accountTradingRules = $this->accountTradingRulesRepository->update($request->all(), $id);

        Flash::success('Account Trading Rules updated successfully.');

        return redirect(route('accountTradingRules.index'));
    }

    /**
     * Remove the specified AccountTradingRules from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accountTradingRules = $this->accountTradingRulesRepository->find($id);

        if (empty($accountTradingRules)) {
            Flash::error('Account Trading Rules not found');

            return redirect(route('accountTradingRules.index'));
        }

        $this->accountTradingRulesRepository->delete($id);

        Flash::success('Account Trading Rules deleted successfully.');

        return redirect(route('accountTradingRules.index'));
    }
}
