<?php

namespace App\Http\Controllers;

use App\Models\AccountMatchingRule;
use Illuminate\Http\Request;

/**
 * Class AccountMatchingRuleController
 * @package App\Http\Controllers
 */
class AccountMatchingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountMatchingRules = AccountMatchingRule::paginate();

        return view('account-matching-rule.index', compact('accountMatchingRules'))
            ->with('i', (request()->input('page', 1) - 1) * $accountMatchingRules->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountMatchingRule = new AccountMatchingRule();
        return view('account-matching-rule.create', compact('accountMatchingRule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AccountMatchingRule::$rules);

        $accountMatchingRule = AccountMatchingRule::create($request->all());

        return redirect()->route('account-matching-rules.index')
            ->with('success', 'AccountMatchingRule created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accountMatchingRule = AccountMatchingRule::find($id);

        return view('account-matching-rule.show', compact('accountMatchingRule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accountMatchingRule = AccountMatchingRule::find($id);

        return view('account-matching-rule.edit', compact('accountMatchingRule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AccountMatchingRule $accountMatchingRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountMatchingRule $accountMatchingRule)
    {
        request()->validate(AccountMatchingRule::$rules);

        $accountMatchingRule->update($request->all());

        return redirect()->route('account-matching-rules.index')
            ->with('success', 'AccountMatchingRule updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $accountMatchingRule = AccountMatchingRule::find($id)->delete();

        return redirect()->route('account-matching-rules.index')
            ->with('success', 'AccountMatchingRule deleted successfully');
    }
}
