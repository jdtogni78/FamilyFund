<?php

namespace App\Http\Controllers\API;

use App\Models\Portfolios;
use App\Models\PortfoliosExt;
// use App\Models\AccountAssets;
use App\Repositories\AccountsRepository;
use App\Repositories\AccountBalancesRepository;
use App\Repositories\FundsRepository;
// use App\Repositories\AssetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AccountsAPIController;
use App\Http\Resources\AccountsResource;
use Response;

/**
 * Class AccountsController
 * @package App\Http\Controllers\API
 */

class AccountsAPIControllerExt extends AccountsAPIController
{
    public function __construct(AccountsRepository $accountsRepo)
    {
        parent::__construct($accountsRepo);
    }

    /**
     * Display the specified Accounts.
     * GET|HEAD /Accounts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Accounts $Accounts */
        $accounts = $this->accountsRepository->find($id);

        if (empty($accounts)) {
            return $this->sendError('Account not found');
        }

        // TODO: allow date as param
        $now = date('Y-m-d');

        $rss = new AccountsResource($accounts);
        $arr = $rss->toArray(NULL);

        // TODO: move this to a more appropriate place: model? AB controller?
        $accountBalancesRepo = \App::make(AccountBalancesRepository::class);
        $query = $accountBalancesRepo->makeModel()->newQuery();
        $query->where('account_id', $id);
        $query->whereDate('start_dt', '<=', $now);
        $query->whereDate('end_dt', '>', $now);
        $accountBalances = $query->get(['*']);

        $fund = $accounts->fund()->get()->first();
        $totalShares = $fund['total_shares'];
        $portfolio = $fund->portfolios()->get()->first();
        $portfolioExt = PortfoliosExt::findOrFail($portfolio['id']);
        $totalValue = $portfolioExt->totalValue($now);

        $arr['balances'] = array();
        foreach ($accountBalances as $ab) {
            $balance = array();
            $balance['type'] = $ab['type'];
            $balance['shares'] = $ab['shares'];
            $balance['market_value'] = ((int)(($totalValue / $totalShares) * $ab['shares'] * 100))/100;
            array_push($arr['balances'], $balance);
        }

        $arr['as_of'] = $now;

        return $this->sendResponse($arr, 'Account retrieved successfully');
    }
}
