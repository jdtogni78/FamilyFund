<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

/**
 * Class FundController
 * @package App\Http\Controllers
 */
class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funds = Fund::paginate();

        return view('fund.index', compact('funds'))
            ->with('i', (request()->input('page', 1) - 1) * $funds->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fund = new Fund();
        return view('fund.create', compact('fund'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Fund::$rules);

        $fund = Fund::create($request->all());

        return redirect()->route('funds.index')
            ->with('success', 'Fund created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fund = Fund::find($id);

        return view('fund.show', compact('fund'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fund = Fund::find($id);

        return view('fund.edit', compact('fund'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Fund $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        request()->validate(Fund::$rules);

        $fund->update($request->all());

        return redirect()->route('funds.index')
            ->with('success', 'Fund updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $fund = Fund::find($id)->delete();

        return redirect()->route('funds.index')
            ->with('success', 'Fund deleted successfully');
    }
}
