<?php

namespace App\Http\Controllers\APIv1;

use App\Http\Controllers\API\TradePortfolioAPIController;
use App\Http\Controllers\Traits\VerboseTrait;
use App\Models\TradePortfolioExt;
use App\Models\Utils;
use App\Repositories\TradePortfolioRepository;
use App\Http\Resources\TradePortfolioResource;
use App\Http\Resources\TradePortfolioItemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Response;

/**
 * Class TradePortfolioController
 * @package App\Http\Controllers\API
 */

class TradePortfolioAPIControllerExt extends TradePortfolioAPIController
{
    use VerboseTrait;

    public function __construct(TradePortfolioRepository $tradePortfolioRepo)
    {
        parent::__construct($tradePortfolioRepo);
    }

    public function index(Request $request)
    {
        $asOf = $request->route("asOf") ?? date('Y-m-d');
        $asOf .= "T23:59:59";

        $tradePortfolios = $this->tradePortfolioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        )
            ->whereNotNull('portfolio_id')
            ->where('start_dt', '<=', $asOf)
            ->where('end_dt', '>', $asOf);

        $this->debug("TRADE PORTFOLIOS: " . json_encode($tradePortfolios));
        $arr = [];
        foreach ($tradePortfolios as $tradePortfolio) {
            $arr[] = $this->createTradePortfolioResponse($tradePortfolio, $asOf);
        }
        return $this->sendResponse($arr, 'Trade Portfolios retrieved successfully');
    }

    /**
     * Display the specified TradePortfolio.
     * GET|HEAD /tradePortfolios/{accountName}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($accountName)
    {
        $request = request();
        $asOf = $request->asOf ?? date('Y-m-d');
        $asOf .= "T23:59:59";
        $this->debug("TRADE PORTFOLIO: " . $accountName . " " . $asOf);
        # TODO: should be tested separately - end date comparison is wrong
        /** @var TradePortfolioExt $tradePortfolio */
        $tradePortfolio = $this->tradePortfolioRepository->all()
            ->whereNotNull('portfolio_id')
            ->where('start_dt', '<=', $asOf)
            ->where('end_dt', '>', $asOf)
            ->firstWhere('account_name', $accountName);

        if (empty($tradePortfolio)) {
            return $this->sendError('Trade Portfolio not found');
        }

        $arr = $this->createTradePortfolioResponse($tradePortfolio, $asOf);

        return $this->sendResponse($arr, 'Trade Portfolio retrieved successfully');
    }

    private function createTradePortfolioResponse(TradePortfolioExt $tradePortfolio, $asOf)
    {
        $rss = new TradePortfolioResource($tradePortfolio);
        $ret = $rss->toArray(NULL);

        $port = $tradePortfolio->portfolio;
        $prevYearAsOf = Utils::asOfAddYear($asOf, -1);
        if ($port != null) {
            $maxCash = $port->maxCashBetween($prevYearAsOf, $asOf);
            $ret['max_cash_last_year'] = Utils::currency($maxCash);
            $ret['source'] = $port->source;
        }

        $ret['items'] = TradePortfolioItemResource::collection($tradePortfolio->tradePortfolioItems);

        return $ret;
    }

}
