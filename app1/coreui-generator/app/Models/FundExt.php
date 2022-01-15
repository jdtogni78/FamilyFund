<?php

namespace App\Models;

use App\Models\Fund;
use App\Repositories\AccountRepository;
use App\Models\Utils;

/**
 * Class FundExt
 * @package App\Models
 */
class FundExt extends Fund
{
    public function portfolio()
    {
        return $this->portfolios()->first();
    }

    public function account()
    {
        $accountRepo = \App::make(AccountRepository::class);
        $query = $accountRepo->makeModel()->newQuery();
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
        $balance = $this->account()->ownedSharesAsOf($now);
        return Utils::shares($balance);
    }

    public function valueAsOf($now)
    {
        return $this->portfolio()->valueAsOf($now);
    }

    public function shareValueAsOf($now)
    {
        $value = $this->valueAsOf($now);
        $shares = $this->sharesAsOf($now);
        if ($shares == 0) return 0;
        return Utils::currency($value/$shares);
    }

    public function allocatedShares($now, $inverse=false) {
        $accountRepo = \App::make(AccountRepository::class);
        $query = $accountRepo->makeModel()->newQuery();
        $query->where('fund_id', $this->id);
        $accounts = $query->get(['*']);
        
        $used = 0;
        $total = 0;
        foreach ($accounts as $account) {
            $balance = $account->ownedSharesAsOf($now);
            if ($account->user_id) {
                $used += $balance;
            } else {
                $total = $balance;
            }
        }
    
        return Utils::shares($inverse? $total-$used : $used);
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
