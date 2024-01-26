<?php

namespace App\Http\Controllers\APIv1;

use App\Http\Controllers\API\TradePortfolioAPIController;
use App\Models\TradePortfolioExt;
use App\Models\Utils;
use App\Repositories\TradePortfolioRepository;
use App\Http\Resources\TradePortfolioResource;
use App\Http\Resources\TradePortfolioItemResource;
use Illuminate\Http\Request;
use Response;

/**
 * Class TradePortfolioController
 * @package App\Http\Controllers\API
 */

class TradePortfolioAPIControllerExt extends TradePortfolioAPIController
{
    public function __construct(TradePortfolioRepository $tradePortfolioRepo)
    {
        parent::__construct($tradePortfolioRepo);
    }

    public function index(Request $request)
    {
        $asOf = date('Y-m-d');
        $tradePortfolios = $this->tradePortfolioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        )
            ->where('portfolio_id', '>', 0)
            ->where('start_dt', '<=', $asOf)
            ->where('end_dt', '>', $asOf);

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
        $asOf = date('Y-m-d');
        /** @var TradePortfolioExt $tradePortfolio */
        $tradePortfolio = $this->tradePortfolioRepository->all()
            ->where('start_dt', '<=', $asOf)
            ->where('end_dt', '>', $asOf)
            ->firstWhere('account_name', $accountName);

        if (empty($tradePortfolio)) {
            return $this->sendError('Trade Portfolio not found');
        }

        $asOf = date('Y-m-d');
        $arr = $this->createTradePortfolioResponse($tradePortfolio, $asOf);

        return $this->sendResponse($arr, 'Trade Portfolio retrieved successfully');
    }

    private function createTradePortfolioResponse(TradePortfolioExt $tradePortfolio, $asOf)
    {
        $rss = new TradePortfolioResource($tradePortfolio);
        $ret = $rss->toArray(NULL);

        $port = $tradePortfolio->portfolio()->first();
        $prevYearAsOf = Utils::asOfAddYear($asOf, -1);
        if ($port != null) {
            $maxCash = $port->maxCashBetween($prevYearAsOf, $asOf);
            $ret['max_cash_last_year'] = Utils::currency($maxCash);
            $ret['source'] = $port['source'];
        }

        $ret['items'] = TradePortfolioItemResource::collection($tradePortfolio->tradePortfolioItems);

        return $ret;
    }

}
