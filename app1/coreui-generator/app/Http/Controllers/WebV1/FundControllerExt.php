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
    public function show($id, $asOf='2022-01-01')
    {
        /** @var Fund $fund */
        $fund = $this->fundRepository->find($id);

        if (empty($fund)) {
            Flash::error('Fund not found');

            return redirect(route('funds.index'));
        }

        $arr = array();

        $value = $arr['value']      = Utils::currency($fund->valueAsOf($asOf));
        $shares = $arr['shares']    = Utils::shares($fund->sharesAsOf($asOf));
        $arr['unallocated_shares']  = Utils::shares($fund->unallocatedShares($asOf));
        $arr['share_value']         = Utils::currency($shares? $value/$shares : 0);
        $arr['as_of'] = $asOf;

        return view('funds.show')
            ->with('fund', $fund)
            ->with('calculated', $arr);
    }

}
