<?php

namespace App\Models;

use App\Models\Account;
use App\Repositories\AccountBalanceRepository;

/**
 * Class AccountExt
 * @package App\Models
 */
class AccountExt extends Account
{
    /**
     **/
    public function balanceAsOf($now)
    {
        $accountBalanceRepo = \App::make(AccountBalanceRepository::class);
        $query = $accountBalanceRepo->makeModel()->newQuery();
        $query->where('account_id', $this->id);
        $query->whereDate('start_dt', '<=', $now);
        $query->whereDate('end_dt', '>', $now);
        $accountBalances = $query->get(['*']);
        return $accountBalances;
    }

    public function ownBalanceAsOf($now) {
        $accountBalances = $this->balanceAsOf($now);
        foreach ($accountBalances as $balance) {
            if ($balance->type == 'OWN') {
                return $balance->shares;
            }
        }
        return 0;
    }

    public function remainingMatchings() { 
        return NULL; 
    }
}
