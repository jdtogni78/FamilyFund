<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFundsAPIRequest;
use App\Http\Requests\API\UpdateFundsAPIRequest;
use App\Models\Funds;
use App\Models\FundAssets;
use App\Repositories\FundsRepository;
use App\Repositories\FundAssetsRepository;
use App\Repositories\AssetPricesRepository;
use App\Repositories\AssetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\FundsAPIController;
use App\Http\Resources\FundsResource;
use Response;

/**
 * Class FundsControllerExt
 * @package App\Http\Controllers\API
 */

class FundsAPIControllerExt extends FundsAPIController
{
    public function __construct(FundsRepository $fundsRepo)
    {
        parent::__construct($fundsRepo);
    }

    /**
     * Display the specified Funds.
     * GET|HEAD /funds/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Funds $funds */
        $funds = $this->fundsRepository->find($id);

        if (empty($funds)) {
            return $this->sendError('Fund not found');
        }

        $now = date('Y-m-d');

        $rss = new FundsResource($funds);
        $ret = $rss->toArray(NULL);
        $arr = array();

        $value = $arr['value'] = $funds->valueAsOf($now);
        $shares = $arr['shares'] = $funds->sharesAsOf($now);
        $arr['unallocated_shares'] = $funds->unallocatedShares($now);
        $arr['share_value'] = $value/$shares;
        $arr['as_of'] = $now;

        $year = date('Y');
        $yearStart = $year.'-01-01';

        $perf = array();
        $perf['year-to-date'] = $funds->periodPerformance($yearStart, $now);

        for ($year--; $year >= 2021; $year--) {
            $perf[$year] = $funds->yearlyPerformance($year);
        }
        $arr['performance'] = $perf;

        $ret['calculated'] = $arr;
        return $this->sendResponse($ret, 'Fund retrieved successfully');
    }
}
