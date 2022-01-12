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

    /**
     * @return money
     **/
    public function shares($now)
    {
        $account = $this->account();
        // TODO: add throws to models
        // if ($account == null) {
        //     throw 
        // }
        $balance = $this->account()->first()->ownBalanceAsOf($now);
        return ((int) ($balance * 10000)) / 10000;
    }

    public function value($now)
    {
        $portfolio = $this->portfolios()->get()->first();
        $totalValue = $portfolio->value($now);
        return $totalValue;
    }

    public function allocatedShares($now, $inverse=false) {
        $accountsRepo = \App::make(AccountsRepository::class);
        $query = $accountsRepo->makeModel()->newQuery();
        $query->where('fund_id', $this->id);
        $accounts = $query->get(['*']);
        
        $used = 0;
        $total = 0;
        foreach ($accounts as $account) {
            $balance = $account->ownBalanceAsOf($now);
            if ($account->user_id) {
                $used += $balance;
            } else {
                $total = $balance;
            }
        }
    
        return ((int) (($inverse? $total-$used : $used) * 10000)) / 10000;
    }

    public function unallocatedShares($now) {
        return $this->allocatedShares($now, true);
    }
}
