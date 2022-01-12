<?php

namespace App\Models;

use App\Models\Accounts;
use App\Repositories\AccountBalancesRepository;

/**
 * Class AccountsExt
 * @package App\Models
 */
class AccountsExt extends Accounts
{
    /**
     **/
    public function balanceAsOf($now)
    {
        $accountBalancesRepo = \App::make(AccountBalancesRepository::class);
        $query = $accountBalancesRepo->makeModel()->newQuery();
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
}
