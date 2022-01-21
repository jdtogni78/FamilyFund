<?php

namespace App\Http\Controllers\WebV1;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\APIv1\AccountAPIControllerExt;
use App\Repositories\AccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;


class AccountControllerExt extends AccountController
{
    public function __construct(AccountRepository $accountRepo)
    {
        parent::__construct($accountRepo);
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
     * Display the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function showAsOf($id, $asOf=null)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');
            return redirect(route('accounts.index'));
        }

        if ($asOf == null) $asOf = date('Y-m-d');

        $arr = array();
        $api = new AccountAPIControllerExt($this->accountRepository);
        $arr = $api->createAccountResponse($account, $asOf);
        $arr['performance'] = $api->createPerformanceResponse($account, $asOf);
        $arr['transactions'] = $api->createTransactionsResponse($account, $asOf);
        $arr['as_of'] = $asOf;

        return view('accounts.show_ext')->with('api', $arr);
    }
}
