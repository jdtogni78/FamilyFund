<?php

namespace App\Http\Controllers\API;

use App\Models\Portfolio;
use App\Models\PortfolioExt;
use App\Models\Utils;
// use App\Models\AccountAssets;
use App\Repositories\AccountRepository;
use App\Repositories\AccountBalanceRepository;
use App\Repositories\FundRepository;
// use App\Repositories\AssetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AccountAPIController;
use App\Http\Resources\AccountResource;
use Response;
use Carbon\Carbon;

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
        $now = date('Y-m-d');
        return $this->showAsOf($id, $now);
    }

    /**
     * Display the specified Accounts.
     * GET|HEAD /Accounts/{id}/as_of/{date}
     *
     * @param int $id
     *
     * @return Response
     */
    public function showAsOf($id, $asOf)
    {
        /** @var Accounts $account */
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            return $this->sendError('Account not found');
        }

        $rss = new AccountResource($account);
        $arr = $rss->toArray(NULL);

        // TODO: move this to a more appropriate place: model? AB controller?

        $fund = $account->fund();
        $totalShares = $fund->sharesAsOf($asOf);
        $totalValue = $fund->valueAsOf($asOf);
        $shareValue = $totalShares > 0 ? $totalValue / $totalShares : 0;

        $accountBalance = $account->allSharesAsOf($asOf);
        $arr['balances'] = array();
        foreach ($accountBalance as $ab) {
            $balance = array();
            $balance['type'] = $ab['type'];
            $balance['shares'] = Utils::shares($ab['shares']);
            $balance['market_value'] = Utils::currency(($totalValue / $totalShares) * $ab['shares']);
            array_push($arr['balances'], $balance);
        }

        $transactions = $account->transactions()->get();
        $arr['transactions'] = array();
        foreach ($transactions as $transaction) {
            $tran = array();
            if ($transaction->created_at->gte(Carbon::createFromFormat('Y-m-d', $asOf)))
                continue;
            $tran['type'] = $transaction->type;
            $tran['shares'] = Utils::shares($transaction->shares);
            $tran['value'] = Utils::currency($transaction->value);
            if ($transaction->matching_rule_id)
                $tran['matching_id'] = $transaction->matching_rule_id;
            $tran['current_value'] = Utils::currency($transaction->shares * $shareValue * 100);
            $tran['created_at'] = $transaction->created_at;
            array_push($arr['transactions'], $tran);
        }

        $perf = array();
        $year = date('Y');
        $yearStart = $year.'-01-01';

        $perf[$asOf . '-shares'] = $account->ownedSharesAsOf($asOf);
        $perf[$asOf . '-value'] = $account->valueAsOf($asOf);

        for ($year; $year >= 2021; $year--) {
            $perf[$year . '-yearly'] = $account->yearlyPerformance($year);
            $perf[$year . '-01-01-shares'] = $account->ownedSharesAsOf($year . '-01-01');
            $perf[$year . '-01-01-value'] = $account->valueAsOf($year . '-01-01');
        }
        $arr['performance'] = $perf;

        $arr['as_of'] = $asOf;

        return $this->sendResponse($arr, 'Account retrieved successfully');
    }
}
