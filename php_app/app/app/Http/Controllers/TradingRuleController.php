<?php

namespace App\Http\Controllers;

use App\Models\TradingRule;
use Illuminate\Http\Request;

/**
 * Class TradingRuleController
 * @package App\Http\Controllers
 */
class TradingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tradingRules = TradingRule::paginate();

        return view('trading-rule.index', compact('tradingRules'))
            ->with('i', (request()->input('page', 1) - 1) * $tradingRules->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tradingRule = new TradingRule();
        return view('trading-rule.create', compact('tradingRule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TradingRule::$rules);

        $tradingRule = TradingRule::create($request->all());

        return redirect()->route('trading-rules.index')
            ->with('success', 'TradingRule created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tradingRule = TradingRule::find($id);

        return view('trading-rule.show', compact('tradingRule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tradingRule = TradingRule::find($id);

        return view('trading-rule.edit', compact('tradingRule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TradingRule $tradingRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TradingRule $tradingRule)
    {
        request()->validate(TradingRule::$rules);

        $tradingRule->update($request->all());

        return redirect()->route('trading-rules.index')
            ->with('success', 'TradingRule updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tradingRule = TradingRule::find($id)->delete();

        return redirect()->route('trading-rules.index')
            ->with('success', 'TradingRule deleted successfully');
    }
}
