<?php

namespace App\Http\Controllers\WebV1;

use App\Repositories\FundRepository;
use Flash;
use Response;
use App\Http\Controllers\FundController;
use App\Http\Controllers\APIv1\FundAPIControllerExt;
use App\Http\Controllers\APIv1\PortfolioAPIControllerExt;
use App\Models\PerformanceTrait;
use App\Repositories\PortfolioRepository;

class FundControllerExt extends FundController
{
    use PerformanceTrait;

    public function __construct(FundRepository $fundRepo)
    {
        parent::__construct($fundRepo);
    }

    /**
     * Display the specified Fund.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return $this->showAsOf($id, null);
    }

    /**
     * Display the specified Fund.
     *
     * @param int $id
     *
     * @return Response
     */
    public function showAsOf($id, $asOf=null)
    {
        /** @var Fund $fund */
        $fund = $this->fundRepository->find($id);

        if (empty($fund)) {
            Flash::error('Fund not found');

            return redirect(route('funds.index'));
        }

        if ($asOf == null) $asOf = date('Y-m-d');

        $arr = array();
        $api = new FundAPIControllerExt($this->fundRepository);
        $arr = $api->createFundResponse($fund, $asOf);
        $arr['monthly_performance'] = $api->createMonthlyPerformanceResponse($asOf);
        $arr['yearly_performance'] = $api->createYearlyPerformanceResponse($asOf);
        $arr['balances'] = $api->createAccountBalancesResponse($fund, $asOf);

        $portController = new PortfolioAPIControllerExt(\App::make(PortfolioRepository::class));
        $portfolio = $fund->portfolios()->first();
        $arr['portfolio'] = $portController->createPortfolioResponse($portfolio, $asOf);

        $arr['as_of'] = $asOf;

        return view('funds.show_ext')
            ->with('api', $arr);
    }

}
