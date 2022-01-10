<?php

namespace App\Models;

use App\Models\Funds;
use App\Repositories\AccountsRepository;


/**
 * Class FundsExt
 * @package App\Models
 */
class FundsExt extends Funds
{
    /**
     **/
    public function account()
    {
        $accountsRepo = \App::make(AccountsRepository::class);
        $query = $accountsRepo->makeModel()->newQuery();
        $query->where('fund_id', $this->id);
        $query->where('user_id', null);
        $accounts = $query->get(['*']);
        return $accounts;
    }
}
