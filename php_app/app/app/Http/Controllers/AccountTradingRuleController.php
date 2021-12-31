<?php

namespace App\Http\Controllers;

use App\Models\AccountTradingRule;
use Illuminate\Http\Request;

/**
 * Class AccountTradingRuleController
 * @package App\Http\Controllers
 */
class AccountTradingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountTradingRules = AccountTradingRule::paginate();

        return view('account-trading-rule.index', compact('accountTradingRules'))
            ->with('i', (request()->input('page', 1) - 1) * $accountTradingRules->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountTradingRule = new AccountTradingRule();
        return view('account-trading-rule.create', compact('accountTradingRule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AccountTradingRule::$rules);

        $accountTradingRule = AccountTradingRule::create($request->all());

        return redirect()->route('account-trading-rules.index')
            ->with('success', 'AccountTradingRule created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accountTradingRule = AccountTradingRule::find($id);

        return view('account-trading-rule.show', compact('accountTradingRule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accountTradingRule = AccountTradingRule::find($id);

        return view('account-trading-rule.edit', compact('accountTradingRule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AccountTradingRule $accountTradingRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountTradingRule $accountTradingRule)
    {
        request()->validate(AccountTradingRule::$rules);

        $accountTradingRule->update($request->all());

        return redirect()->route('account-trading-rules.index')
            ->with('success', 'AccountTradingRule updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $accountTradingRule = AccountTradingRule::find($id)->delete();

        return redirect()->route('account-trading-rules.index')
            ->with('success', 'AccountTradingRule deleted successfully');
    }
}
