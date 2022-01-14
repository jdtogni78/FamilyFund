<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFundAPIRequest;
use App\Http\Requests\API\UpdateFundAPIRequest;
use App\Models\Fund;
use App\Models\FundAssets;
use App\Repositories\FundRepository;
use App\Repositories\FundAssetsRepository;
use App\Repositories\AssetPricesRepository;
use App\Repositories\AssetsRepository;
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
        /** @var Fund $fund */
        $fund = $this->fundRepository->find($id);

        if (empty($fund)) {
            return $this->sendError('Fund not found');
        }

        $now = date('Y-m-d');

        $rss = new FundResource($fund);
        $ret = $rss->toArray(NULL);
        $arr = array();

        $value = $arr['value'] = $fund->valueAsOf($now);
        $shares = $arr['shares'] = $fund->sharesAsOf($now);
        $arr['unallocated_shares'] = $fund->unallocatedShares($now);
        $arr['share_value'] = $value/$shares;
        $arr['as_of'] = $now;

        $year = date('Y');
        $yearStart = $year.'-01-01';

        $perf = array();
        $perf['year-to-date'] = $fund->periodPerformance($yearStart, $now);

        for ($year--; $year >= 2021; $year--) {
            $perf[$year] = $fund->yearlyPerformance($year);
        }
        $arr['performance'] = $perf;

        $ret['calculated'] = $arr;
        return $this->sendResponse($ret, 'Fund retrieved successfully');
    }
}
