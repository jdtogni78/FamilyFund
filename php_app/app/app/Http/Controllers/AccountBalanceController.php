<?php

namespace App\Http\Controllers;

use App\Models\AccountBalance;
use Illuminate\Http\Request;

/**
 * Class AccountBalanceController
 * @package App\Http\Controllers
 */
class AccountBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountBalances = AccountBalance::paginate();

        return view('account-balance.index', compact('accountBalances'))
            ->with('i', (request()->input('page', 1) - 1) * $accountBalances->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountBalance = new AccountBalance();
        return view('account-balance.create', compact('accountBalance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AccountBalance::$rules);

        $accountBalance = AccountBalance::create($request->all());

        return redirect()->route('account-balances.index')
            ->with('success', 'AccountBalance created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accountBalance = AccountBalance::find($id);

        return view('account-balance.show', compact('accountBalance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accountBalance = AccountBalance::find($id);

        return view('account-balance.edit', compact('accountBalance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AccountBalance $accountBalance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountBalance $accountBalance)
    {
        request()->validate(AccountBalance::$rules);

        $accountBalance->update($request->all());

        return redirect()->route('account-balances.index')
            ->with('success', 'AccountBalance updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $accountBalance = AccountBalance::find($id)->delete();

        return redirect()->route('account-balances.index')
            ->with('success', 'AccountBalance deleted successfully');
    }
}
