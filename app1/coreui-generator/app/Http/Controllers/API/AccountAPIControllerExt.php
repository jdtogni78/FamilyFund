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
     * GET|HEAD /accounts/{id}/as_of/{date}
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

        $fund = $account->fund()->first();
        $shareValue = $fund->shareValueAsOf($asOf);

        $accountBalance = $account->allSharesAsOf($asOf);
        $arr['balances'] = array();
        foreach ($accountBalance as $ab) {
            $balance = array();
            $balance['type'] = $ab['type'];
            $balance['shares'] = Utils::shares($ab['shares']);
            $balance['market_value'] = Utils::currency($shareValue * $ab['shares']);
            array_push($arr['balances'], $balance);
        }

        $arr['as_of'] = $asOf;

        return $this->sendResponse($arr, 'Account retrieved successfully');
    }

    public function createAccountArray($account)
    {
        $arr = array();
        $arr['nickname'] = $account->nickname;
        $arr['id'] = $account->id;
        return $arr;
    }

    /**
     * Display the specified Accounts.
     * GET|HEAD /accounts/{id}/performance_as_of/{date}
     *
     * @param int $id
     *
     * @return Response
     */
    public function showPerformanceAsOf($id, $asOf)
    {
        /** @var Accounts $account */
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            return $this->sendError('Account not found');
        }

        $arr = $this->createAccountArray($account);

        $year = date('Y');
        $yearStart = $year.'-01-01';


        $perf = array();
        if ($asOf != $yearStart) {
            $yp = array();
            $yp['value']        = Utils::currency($account->valueAsOf($asOf));
            $yp['shares']       = Utils::shares($account->ownedSharesAsOf($asOf));
            $perf[$asOf] = $yp;
        }

        for ($year; $year >= 2021; $year--) {
            $yearStart = $year.'-01-01';
            $yp = array();
            $yp['value']        = Utils::currency($account->valueAsOf($yearStart));
            $yp['shares']       = Utils::shares($account->ownedSharesAsOf($yearStart));
            $yp['performance']  = Utils::percent($account->yearlyPerformance($year));
            $perf[$year] = $yp;
        }

        $arr['as_of'] = $asOf;

        return $this->sendResponse($arr, 'Account retrieved successfully');
    }

    /**
     * Display the specified Accounts.
     * GET|HEAD /accounts/{id}/transactions_as_of/{date}
     *
     * @param int $id
     *
     * @return Response
     */
    public function showTransactionsAsOf($id, $asOf)
    {
        /** @var Accounts $account */
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            return $this->sendError('Account not found');
        }

        $arr = array();
        $arr['nickname'] = $account->nickname;
        $arr['id'] = $account->id;

        // TODO: move this to a more appropriate place: model? AB controller?

        $fund = $account->fund()->first();
        $shareValue = $fund->shareValueAsOf($asOf);

        $transactions = $account->transactions()->get();
        $arr['transactions'] = array();
        foreach ($transactions as $transaction) {
            $tran = array();
            if ($transaction->created_at->gte(Carbon::createFromFormat('Y-m-d', $asOf)))
                continue;
            $tran['id'] = $transaction->id;
            $tran['type'] = $transaction->type;
            $tran['shares'] = Utils::shares($transaction->shares);
            $tran['value'] = Utils::currency($transaction->value);
            if ($transaction->matching_rule_id)
                $tran['matching_id'] = $transaction->matching_rule_id;
            $tran['current_value'] = Utils::currency($transaction->shares * $shareValue);
            $tran['created_at'] = $transaction->created_at;
            array_push($arr['transactions'], $tran);
        }

        return $this->sendResponse($arr, 'Account retrieved successfully');
    }
}
