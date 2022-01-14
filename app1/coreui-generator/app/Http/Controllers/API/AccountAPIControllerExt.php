<?php

namespace App\Http\Controllers\API;

use App\Models\Portfolio;
use App\Models\PortfolioExt;
// use App\Models\AccountAssets;
use App\Repositories\AccountRepository;
use App\Repositories\AccountBalanceRepository;
use App\Repositories\FundRepository;
// use App\Repositories\AssetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AccountAPIController;
use App\Http\Resources\AccountResource;
use Response;

/**
 * Class AccountsController
 * @package App\Http\Controllers\API
 */

class AccountAPIControllerExt extends AccountAPIController
{
    public function __construct(AccountRepository $accountRepo)
    {
        parent::__construct($accountRepo);
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
        /** @var Accounts $account */
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            return $this->sendError('Account not found');
        }

        // TODO: allow date as param
        $now = date('Y-m-d');

        $rss = new AccountResource($account);
        $arr = $rss->toArray(NULL);

        // TODO: move this to a more appropriate place: model? AB controller?

        $fund = $account->fund()->get()->first();
        $totalShares = $fund->sharesAsOf($now);
        $totalValue = $fund->valueAsOf($now);
        $shareValue = $totalValue / $totalShares;

        $accountBalance = $account->balanceAsOf($now);
        $arr['balances'] = array();
        foreach ($accountBalance as $ab) {
            $balance = array();
            $balance['type'] = $ab['type'];
            $balance['shares'] = $ab['shares'];
            $balance['market_value'] = ((int)(($totalValue / $totalShares) * $ab['shares'] * 100))/100;
            array_push($arr['balances'], $balance);
        }

        $transactions = $account->transactions()->get();
        $arr['transactions'] = array();
        foreach ($transactions as $transaction) {
            $tran = array();
            $tran['type'] = $transaction->type;
            $tran['shares'] = $transaction->shares;
            $tran['value'] = $transaction->value;
            $tran['current_value'] = ((int) ($transaction->shares * $shareValue * 100))/100;
            array_push($arr['transactions'], $tran);
        }

        $arr['as_of'] = $now;

        return $this->sendResponse($arr, 'Account retrieved successfully');
    }
}
