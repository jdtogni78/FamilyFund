<?php

namespace App\Http\Controllers\APIv1;

use App\Models\Fund;
use App\Models\Utils;
use App\Repositories\FundRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FundResource;
use Response;

/**
 * Class FundControllerExt
 * @package App\Http\Controllers\API
 */

class FundAPIControllerExt extends AppBaseController
{
    protected $fundRepository;
    public function __construct(FundRepository $fundRepo)
    {
        $this->fundRepository = $fundRepo;
    }

    public function createFundResponse($fund, $asOf)
    {
        $rss = new FundResource($fund);
        $ret = $rss->toArray(NULL);
        
        $arr = array();
        $value = $arr['value']      = Utils::currency($fund->valueAsOf($asOf));
        $shares = $arr['shares']    = Utils::shares($fund->sharesAsOf($asOf));
        $arr['unallocated_shares']  = Utils::shares($fund->unallocatedShares($asOf));
        $arr['share_value']         = Utils::currency($shares? $value/$shares : 0);
        $ret['summary'] = $arr;

        return $ret;
    }

    public function createFundArray($fund, $asOf) {
        $arr = array();
        $arr['id'] = $fund->id;
        $arr['name'] = $fund->name;
        return $arr;       
    }

    public function createPerformanceResponse($fund, $asOf)
    {
        $arr = array();

        $year = substr($asOf,0,4);
        $yearStart = $year.'-01-01';

        if ($asOf != $yearStart) {
            $yp = array();
            $yp['value']        = Utils::currency($fund->valueAsOf($asOf));
            $yp['shares']       = Utils::shares($fund->sharesAsOf($asOf));
            $yp['share_value']   = Utils::currency($fund->shareValueAsOf($asOf));
            $yp['performance']  = Utils::percent($fund->periodPerformance($yearStart, $asOf));
            $arr[$asOf] = $yp;
        }

        for ($year; $year >= 2021; $year--) {
            $yearStart = $year.'-01-01';
            $yp = array();
            $yp['value']        = Utils::currency($fund->valueAsOf($yearStart));
            $yp['shares']       = Utils::shares($fund->sharesAsOf($yearStart));
            $yp['share_value']   = Utils::currency($fund->shareValueAsOf($yearStart));
            $yp['performance']  = Utils::percent($fund->periodPerformance($year, min($yearStart, $asOf)));
            $arr[$year] = $yp;
        }

        return $arr;
    }

    public function createAccountBalancesResponse($fund, $asOf)
    {
        $bals = array();
        $sharePrice = $fund->shareValueAsOf($asOf);
        foreach ($fund->accountBalancesAsOf($asOf) as $balance) {
            $account = $balance->account()->first();
            $user = $account->user()->first();
            
            $bal = array();
            if ($user) {
                $bal['user'] = [
                    'id' => $user->id, 
                    'name' => $user->name,
                ];
            } else {
                continue;
                // $bal['user'] = [
                //     'id' => 0, 
                //     'name' => 'N/A',
                // ];
            }
            $bal['account_id'] = $account->id;
            $bal['nickname'] = $balance->nickname;
            $bal['type'] = $balance->type;
            $bal['shares'] = Utils::shares($balance->shares);
            $bal['value'] = Utils::currency($sharePrice * $balance->shares);
            $bals[] = $bal;
        }
        return $bals;
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

        $arr = $this->createFundResponse($fund, $asOf);
        $arr['as_of'] = $asOf;

        return $this->sendResponse($arr, 'Fund retrieved successfully');
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

        $arr = $this->createFundArray($fund, $asOf);
        $arr['performance'] = $this->createPerformanceResponse($fund, $asOf);
        $arr['as_of'] = $asOf;

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

        $arr = $this->createFundArray($fund, $asOf);
        $arr['balances'] = $this->createAccountBalancesResponse($fund, $asOf);
        $arr['as_of'] = $asOf;

        return $this->sendResponse($arr, 'Fund retrieved successfully');
    }

    /**
     * Display the specified Fund.
     * GET|HEAD /funds/{id}/report_as_of/{date}
     *
     * @param int $id
     *
     * @return Response
     */
    public function showReportAsOf($id, $asOf)
    {
        /** @var Fund $fund */
        $fund = $this->fundRepository->find($id);

        if (empty($fund)) {
            return $this->sendError('Fund not found');
        }

        $arr = $this->createFundResponse($fund, $asOf);
        $arr['performance'] = $this->createPerformanceResponse($fund, $asOf);
        $arr['balances'] = $this->createAccountBalancesResponse($fund, $asOf);
        $arr['as_of'] = $asOf;

        return $this->sendResponse($arr, 'Fund retrieved successfully');
    }
}
