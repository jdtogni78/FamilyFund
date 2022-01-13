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
    public function portfolio()
    {
        return $this->portfolios()->first();
    }

    public function account()
    {
        $accountsRepo = \App::make(AccountsRepository::class);
        $query = $accountsRepo->makeModel()->newQuery();
        $query->where('fund_id', $this->id);
        $query->where('user_id', null);
        $accounts = $query->get(['*']);
        // TODO: add throws to models
        // if ($account == null) {
        //     throw 
        // }
        return $accounts->first();
    }

    /**
     * @return money
     **/
    public function sharesAsOf($now)
    {
        $balance = $this->account()->first()->ownBalanceAsOf($now);
        return ((int) ($balance * 10000)) / 10000;
    }

    public function valueAsOf($now)
    {
        return $this->portfolio()->valueAsOf($now);
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

    public function periodPerformance($from, $to)
    {
        return $this->portfolio()->periodPerformance($from, $to);
    }

    public function yearlyPerformance($year)
    {
        return $this->portfolio()->yearlyPerformance($year);
    }

}
