<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTradingRulesRequest;
use App\Http\Requests\UpdateTradingRulesRequest;
use App\Repositories\TradingRulesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TradingRulesController extends AppBaseController
{
    /** @var  TradingRulesRepository */
    private $tradingRulesRepository;

    public function __construct(TradingRulesRepository $tradingRulesRepo)
    {
        $this->tradingRulesRepository = $tradingRulesRepo;
    }

    /**
     * Display a listing of the TradingRules.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tradingRules = $this->tradingRulesRepository->all();

        return view('trading_rules.index')
            ->with('tradingRules', $tradingRules);
    }

    /**
     * Show the form for creating a new TradingRules.
     *
     * @return Response
     */
    public function create()
    {
        return view('trading_rules.create');
    }

    /**
     * Store a newly created TradingRules in storage.
     *
     * @param CreateTradingRulesRequest $request
     *
     * @return Response
     */
    public function store(CreateTradingRulesRequest $request)
    {
        $input = $request->all();

        $tradingRules = $this->tradingRulesRepository->create($input);

        Flash::success('Trading Rules saved successfully.');

        return redirect(route('tradingRules.index'));
    }

    /**
     * Display the specified TradingRules.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tradingRules = $this->tradingRulesRepository->find($id);

        if (empty($tradingRules)) {
            Flash::error('Trading Rules not found');

            return redirect(route('tradingRules.index'));
        }

        return view('trading_rules.show')->with('tradingRules', $tradingRules);
    }

    /**
     * Show the form for editing the specified TradingRules.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tradingRules = $this->tradingRulesRepository->find($id);

        if (empty($tradingRules)) {
            Flash::error('Trading Rules not found');

            return redirect(route('tradingRules.index'));
        }

        return view('trading_rules.edit')->with('tradingRules', $tradingRules);
    }

    /**
     * Update the specified TradingRules in storage.
     *
     * @param int $id
     * @param UpdateTradingRulesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTradingRulesRequest $request)
    {
        $tradingRules = $this->tradingRulesRepository->find($id);

        if (empty($tradingRules)) {
            Flash::error('Trading Rules not found');

            return redirect(route('tradingRules.index'));
        }

        $tradingRules = $this->tradingRulesRepository->update($request->all(), $id);

        Flash::success('Trading Rules updated successfully.');

        return redirect(route('tradingRules.index'));
    }

    /**
     * Remove the specified TradingRules from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tradingRules = $this->tradingRulesRepository->find($id);

        if (empty($tradingRules)) {
            Flash::error('Trading Rules not found');

            return redirect(route('tradingRules.index'));
        }

        $this->tradingRulesRepository->delete($id);

        Flash::success('Trading Rules deleted successfully.');

        return redirect(route('tradingRules.index'));
    }
}
