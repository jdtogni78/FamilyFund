<?php

namespace App\Http\Controllers;

use App\Models\MatchingRule;
use Illuminate\Http\Request;

/**
 * Class MatchingRuleController
 * @package App\Http\Controllers
 */
class MatchingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matchingRules = MatchingRule::paginate();

        return view('matching-rule.index', compact('matchingRules'))
            ->with('i', (request()->input('page', 1) - 1) * $matchingRules->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matchingRule = new MatchingRule();
        return view('matching-rule.create', compact('matchingRule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(MatchingRule::$rules);

        $matchingRule = MatchingRule::create($request->all());

        return redirect()->route('matching-rules.index')
            ->with('success', 'MatchingRule created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matchingRule = MatchingRule::find($id);

        return view('matching-rule.show', compact('matchingRule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matchingRule = MatchingRule::find($id);

        return view('matching-rule.edit', compact('matchingRule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  MatchingRule $matchingRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MatchingRule $matchingRule)
    {
        request()->validate(MatchingRule::$rules);

        $matchingRule->update($request->all());

        return redirect()->route('matching-rules.index')
            ->with('success', 'MatchingRule updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $matchingRule = MatchingRule::find($id)->delete();

        return redirect()->route('matching-rules.index')
            ->with('success', 'MatchingRule deleted successfully');
    }
}
