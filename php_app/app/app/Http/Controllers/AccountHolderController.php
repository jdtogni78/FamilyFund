<?php

namespace App\Http\Controllers;

use App\Models\AccountHolder;
use Illuminate\Http\Request;

/**
 * Class AccountHolderController
 * @package App\Http\Controllers
 */
class AccountHolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountHolders = AccountHolder::paginate();

        return view('account-holder.index', compact('accountHolders'))
            ->with('i', (request()->input('page', 1) - 1) * $accountHolders->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountHolder = new AccountHolder();
        return view('account-holder.create', compact('accountHolder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AccountHolder::$rules);

        $accountHolder = AccountHolder::create($request->all());

        return redirect()->route('account-holders.index')
            ->with('success', 'AccountHolder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accountHolder = AccountHolder::find($id);

        return view('account-holder.show', compact('accountHolder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accountHolder = AccountHolder::find($id);

        return view('account-holder.edit', compact('accountHolder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AccountHolder $accountHolder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountHolder $accountHolder)
    {
        request()->validate(AccountHolder::$rules);

        $accountHolder->update($request->all());

        return redirect()->route('account-holders.index')
            ->with('success', 'AccountHolder updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $accountHolder = AccountHolder::find($id)->delete();

        return redirect()->route('account-holders.index')
            ->with('success', 'AccountHolder deleted successfully');
    }
}
