<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFundAPIRequest;
use App\Http\Requests\API\UpdateFundAPIRequest;
use App\Models\Fund;
use App\Models\FundAssets;
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

        $value = $arr['value'] = $fund->valueAsOf($asOf);
        $shares = $arr['shares'] = $fund->sharesAsOf($asOf);
        $arr['unallocated_shares'] = $fund->unallocatedShares($asOf);
        $arr['share_value'] = $value/$shares;
        $arr['as_of'] = $asOf;

        $year = date('Y');
        $yearStart = $year.'-01-01';

        $perf = array();
        for ($year; $year >= 2021; $year--) {
            $yearStart = $year.'-01-01';
            $perf[$yearStart . '-value'] = $fund->valueAsOf($yearStart);
            $perf[$yearStart . '-shares'] = $fund->sharesAsOf($yearStart);
            $perf[$yearStart . '-shareValue'] = $fund->shareValueAsOf($yearStart);
            $perf[$year] = $fund->yearlyPerformance($year);
        }
        $arr['performance'] = $perf;

        $ret['calculated'] = $arr;
        return $this->sendResponse($ret, 'Fund retrieved successfully');
    }
}
