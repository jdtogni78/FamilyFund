<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTradingRuleRequest;
use App\Http\Requests\UpdateTradingRuleRequest;
use App\Repositories\TradingRuleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TradingRuleController extends AppBaseController
{
    /** @var  TradingRuleRepository */
    protected $tradingRuleRepository;

    public function __construct(TradingRuleRepository $tradingRuleRepo)
    {
        $this->tradingRuleRepository = $tradingRuleRepo;
    }

    /**
     * Display a listing of the TradingRule.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tradingRules = $this->tradingRuleRepository->all();

        return view('trading_rules.index')
            ->with('tradingRules', $tradingRules);
    }

    /**
     * Show the form for creating a new TradingRule.
     *
     * @return Response
     */
    public function create()
    {
        return view('trading_rules.create');
    }

    /**
     * Store a newly created TradingRule in storage.
     *
     * @param CreateTradingRuleRequest $request
     *
     * @return Response
     */
    public function store(CreateTradingRuleRequest $request)
    {
        $input = $request->all();

        $tradingRule = $this->tradingRuleRepository->create($input);

        Flash::success('Trading Rule saved successfully.');

        return redirect(route('tradingRules.index'));
    }

    /**
     * Display the specified TradingRule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tradingRule = $this->tradingRuleRepository->find($id);

        if (empty($tradingRule)) {
            Flash::error('Trading Rule not found');

            return redirect(route('tradingRules.index'));
        }

        return view('trading_rules.show')->with('tradingRule', $tradingRule);
    }

    /**
     * Show the form for editing the specified TradingRule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tradingRule = $this->tradingRuleRepository->find($id);

        if (empty($tradingRule)) {
            Flash::error('Trading Rule not found');

            return redirect(route('tradingRules.index'));
        }

        return view('trading_rules.edit')->with('tradingRule', $tradingRule);
    }

    /**
     * Update the specified TradingRule in storage.
     *
     * @param int $id
     * @param UpdateTradingRuleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTradingRuleRequest $request)
    {
        $tradingRule = $this->tradingRuleRepository->find($id);

        if (empty($tradingRule)) {
            Flash::error('Trading Rule not found');

            return redirect(route('tradingRules.index'));
        }

        $tradingRule = $this->tradingRuleRepository->update($request->all(), $id);

        Flash::success('Trading Rule updated successfully.');

        return redirect(route('tradingRules.index'));
    }

    /**
     * Remove the specified TradingRule from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tradingRule = $this->tradingRuleRepository->find($id);

        if (empty($tradingRule)) {
            Flash::error('Trading Rule not found');

            return redirect(route('tradingRules.index'));
        }

        $this->tradingRuleRepository->delete($id);

        Flash::success('Trading Rule deleted successfully.');

        return redirect(route('tradingRules.index'));
    }
}
