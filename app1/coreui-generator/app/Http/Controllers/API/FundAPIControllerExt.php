<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFundAPIRequest;
use App\Http\Requests\API\UpdateFundAPIRequest;
use App\Models\Fund;
use App\Models\FundAssets;
use App\Models\Utils;
use App\Repositories\FundRepository;
use App\Repositories\FundAssetRepository;
use App\Repositories\AssetPricesRepository;
use App\Repositories\AssetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\FundAPIController;
use App\Http\Resources\FundResource;
use Response;

/**
 * Class FundControllerExt
 * @package App\Http\Controllers\API
 */

class FundAPIControllerExt extends FundAPIController
{
    public function __construct(FundRepository $fundRepo)
    {
        parent::__construct($fundRepo);
    }

    /**
     * Display the specified Fund.
     * GET|HEAD /funds/{id}
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
     * Display the specified Fund.
     * GET|HEAD /funds/{id}/as_of/{date}
     *
     * @param int $id
     *
     * @return Response
     */
    public function showAsOf($id, $asOf)
    {
        /** @var Fund $fund */
        $fund = $this->fundRepository->find($id);

        if (empty($fund)) {
            return $this->sendError('Fund not found');
        }

        $rss = new FundResource($fund);
        $ret = $rss->toArray(NULL);
        $arr = array();

        $value = $arr['value']      = Utils::currency($fund->valueAsOf($asOf));
        $shares = $arr['shares']    = Utils::shares($fund->sharesAsOf($asOf));
        $arr['unallocated_shares']  = Utils::shares($fund->unallocatedShares($asOf));
        $arr['share_value']         = Utils::currency($shares? $value/$shares : 0);
        $arr['as_of'] = $asOf;

        $ret['calculated'] = $arr;
        return $this->sendResponse($ret, 'Fund retrieved successfully');
    }

    /**
     * Display the specified Fund.
     * GET|HEAD /funds/{id}/performance_as_of/{date}
     *
     * @param int $id
     *
     * @return Response
     */
    public function showPerformanceAsOf($id, $asOf)
    {
        /** @var Fund $fund */
        $fund = $this->fundRepository->find($id);

        if (empty($fund)) {
            return $this->sendError('Fund not found');
        }

        $arr = array();
        $arr['id'] = $fund->id;
        $arr['name'] = $fund->name;
        $arr['as_of'] = $asOf;

        $year = substr($asOf,0,4);
        $yearStart = $year.'-01-01';

        $perf = array();
        if ($asOf != $yearStart) {
            $yp = array();
            $yp['value']        = Utils::currency($fund->valueAsOf($asOf));
            $yp['shares']       = Utils::shares($fund->sharesAsOf($asOf));
            $yp['shareValue']   = Utils::currency($fund->shareValueAsOf($asOf));
            $yp['performance']  = Utils::percent($fund->periodPerformance($yearStart, $asOf));
            $perf[$asOf] = $yp;
        }

        for ($year; $year >= 2021; $year--) {
            $yearStart = $year.'-01-01';
            $yp = array();
            $yp['value']        = Utils::currency($fund->valueAsOf($yearStart));
            $yp['shares']       = Utils::shares($fund->sharesAsOf($yearStart));
            $yp['shareValue']   = Utils::currency($fund->shareValueAsOf($yearStart));
            $yp['performance']  = Utils::percent($fund->yearlyPerformance($year));
            $perf[$year] = $yp;
        }


        $arr['performance'] = $perf;

        return $this->sendResponse($arr, 'Fund retrieved successfully');
    }

    /**
     * Display the specified Fund.
     * GET|HEAD /funds/{id}/account_balances_as_of/{date}
     *
     * @param int $id
     *
     * @return Response
     */
    public function showAccountBalancesAsOf($id, $asOf)
    {
        /** @var Fund $fund */
        $fund = $this->fundRepository->find($id);

        if (empty($fund)) {
            return $this->sendError('Fund not found');
        }

        $arr = array();
        $arr['id'] = $fund->id;
        $arr['name'] = $fund->name;
        $arr['as_of'] = $asOf;

        $bals = array();
        foreach ($fund->accountBalancesAsOf($asOf) as $balance) {
            $account = $balance->account()->first();
            
            $bal = array();
            // $user = $account->user()->first();
            // if ($user) {
            //     $bal['user_name'] = $user->name;
            // }
            $bal['user_id'] = $balance->user_id;
            $bal['nickname'] = $balance->nickname;
            $bal['type'] = $balance->type;
            $bal['shares'] = Utils::shares($balance->shares);
            // $bal['start_dt'] = substr($balance->start_dt,0,10);
            // $bal['end_dt'] = substr($balance->end_dt,0,10);
            $bals[] = $bal;
        }
        $arr['balances'] = $bals;

        return $this->sendResponse($arr, 'Fund retrieved successfully');
    }
}
