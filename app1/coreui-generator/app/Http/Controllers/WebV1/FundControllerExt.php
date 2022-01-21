<?php

namespace App\Http\Controllers\WebV1;

use App\Repositories\FundRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Http\Controllers\FundController;
use App\Http\Resources\FundResource;
use App\Models\Utils;
use App\Http\Controllers\APIv1\FundAPIControllerExt;

class FundControllerExt extends FundController
{
    public function __construct(FundRepository $fundRepo)
    {
        parent::__construct($fundRepo);
    }

    /**
     * Display the specified Fund.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return $this->showAsOf($id, null);
    }

    /**
     * Display the specified Fund.
     *
     * @param int $id
     *
     * @return Response
     */
    public function showAsOf($id, $asOf=null)
    {
        /** @var Fund $fund */
        $fund = $this->fundRepository->find($id);

        if (empty($fund)) {
            Flash::error('Fund not found');

            return redirect(route('funds.index'));
        }

        if ($asOf == null) $asOf = date('Y-m-d');

        $arr = array();
        $api = new FundAPIControllerExt($this->fundRepository);
        $arr = $api->createFundResponse($fund, $asOf);
        $arr['performance'] = $api->createPerformanceResponse($fund, $asOf);
        $arr['balances'] = $api->createAccountBalancesResponse($fund, $asOf);
        $arr['as_of'] = $asOf;

        return view('funds.show_ext')
            ->with('api', $arr);
    }

}
