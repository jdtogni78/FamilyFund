<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountTradingRuleRequest;
use App\Http\Requests\UpdateAccountTradingRuleRequest;
use App\Repositories\AccountTradingRuleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AccountTradingRuleController extends AppBaseController
{
    /** @var  AccountTradingRuleRepository */
    protected $accountTradingRuleRepository;

    public function __construct(AccountTradingRuleRepository $accountTradingRuleRepo)
    {
        $this->accountTradingRuleRepository = $accountTradingRuleRepo;
    }

    /**
     * Display a listing of the AccountTradingRule.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $accountTradingRules = $this->accountTradingRuleRepository->all();

        return view('account_trading_rules.index')
            ->with('accountTradingRules', $accountTradingRules);
    }

    /**
     * Show the form for creating a new AccountTradingRule.
     *
     * @return Response
     */
    public function create()
    {
        return view('account_trading_rules.create');
    }

    /**
     * Store a newly created AccountTradingRule in storage.
     *
     * @param CreateAccountTradingRuleRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountTradingRuleRequest $request)
    {
        $input = $request->all();

        $accountTradingRule = $this->accountTradingRuleRepository->create($input);

        Flash::success('Account Trading Rule saved successfully.');

        return redirect(route('accountTradingRules.index'));
    }

    /**
     * Display the specified AccountTradingRule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accountTradingRule = $this->accountTradingRuleRepository->find($id);

        if (empty($accountTradingRule)) {
            Flash::error('Account Trading Rule not found');

            return redirect(route('accountTradingRules.index'));
        }

        return view('account_trading_rules.show')->with('accountTradingRule', $accountTradingRule);
    }

    /**
     * Show the form for editing the specified AccountTradingRule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accountTradingRule = $this->accountTradingRuleRepository->find($id);

        if (empty($accountTradingRule)) {
            Flash::error('Account Trading Rule not found');

            return redirect(route('accountTradingRules.index'));
        }

        return view('account_trading_rules.edit')->with('accountTradingRule', $accountTradingRule);
    }

    /**
     * Update the specified AccountTradingRule in storage.
     *
     * @param int $id
     * @param UpdateAccountTradingRuleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountTradingRuleRequest $request)
    {
        $accountTradingRule = $this->accountTradingRuleRepository->find($id);

        if (empty($accountTradingRule)) {
            Flash::error('Account Trading Rule not found');

            return redirect(route('accountTradingRules.index'));
        }

        $accountTradingRule = $this->accountTradingRuleRepository->update($request->all(), $id);

        Flash::success('Account Trading Rule updated successfully.');

        return redirect(route('accountTradingRules.index'));
    }

    /**
     * Remove the specified AccountTradingRule from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accountTradingRule = $this->accountTradingRuleRepository->find($id);

        if (empty($accountTradingRule)) {
            Flash::error('Account Trading Rule not found');

            return redirect(route('accountTradingRules.index'));
        }

        $this->accountTradingRuleRepository->delete($id);

        Flash::success('Account Trading Rule deleted successfully.');

        return redirect(route('accountTradingRules.index'));
    }
}
