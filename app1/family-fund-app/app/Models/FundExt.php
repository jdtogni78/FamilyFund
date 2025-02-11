<?php

namespace App\Models;

use App\Models\Fund;
use App\Repositories\AccountRepository;
use App\Repositories\AccountBalanceRepository;
use App\Models\Utils;
use App\Repositories\FundRepository;
/**
 * Class FundExt
 * @package App\Models
 */
class FundExt extends Fund
{
    public static function fundMap()
    {
        $fundRepo = \App::make(FundRepository::class);
        $recs = $fundRepo->all([], null, null, ['id', 'name'])->toArray();
        $out = [null => 'Please Select Fund'];
        foreach ($recs as $row) {
            $out[$row['id']] = $row['name'];
        }
        return $out;
    }

    public function portfolio()
    {
        $portfolios = $this->portfolios();
        if ($portfolios->count() != 1)
            throw new \Exception("Every fund must have 1 portfolio (found " . $portfolios->count() . ")");
        return $portfolios->first();
    }

    public function account() : AccountExt
    {
        $accountRepo = \App::make(AccountRepository::class);
        $query = $accountRepo->makeModel()->newQuery();
        $query->where('fund_id', $this->id);
        $query->where('user_id', null);
        $accounts = $query->get(['*']);
        if ($accounts->count() != 1)
            throw new \Exception("Every fund must have 1 account with no user id (found " . $accounts->count() . ")");
        return $accounts->first();
    }

    /**
     * @return money
     **/

    public function sharesAsOf($now)
    {
        $balance = $this->account()->sharesAsOf($now);
        return $balance;
    }

    public function valueAsOf($now, $verbose=false)
    {
        /** @var PortfolioExt $portfolio */
        $portfolio = $this->portfolio();
        return $portfolio->valueAsOf($now, $verbose);
    }

    public function shareValueAsOf($now)
    {
        $value = $this->valueAsOf($now);
        $shares = $this->sharesAsOf($now);
        if ($shares == 0) return 0;
        return $value / $shares;
    }

    public function allocatedShares($now, $inverse=false) {
        $accountRepo = \App::make(AccountRepository::class);
        $query = $accountRepo->makeModel()->newQuery();
        $query->where('fund_id', $this->id);
        $accounts = $query->get(['*']);

        $used = 0;
        $total = 0;
        foreach ($accounts as $account) {
            $balance = $account->sharesAsOf($now);
            if ($account->user_id) {
                $used += $balance;
            } else {
                $total = $balance;
            }
        }

        return $inverse? $total-$used : $used;
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

    public function accountBalancesAsOf($asOf)
    {
        $accountBalanceRepo = \App::make(AccountBalanceRepository::class);
        $query = $accountBalanceRepo->makeModel()->newQuery();
        $query->whereDate('start_dt', '<=', $asOf);
        $query->whereDate('end_dt', '>', $asOf);

        $query->leftJoin('accounts', 'accounts.id', '=', 'account_balances.account_id');
        $query->where('fund_id', '=', $this->id);

        $accountBalances = $query->get(['*']);
        return $accountBalances;
    }

    public function fundAccount()
    {
        return $this->accounts()->where('user_id', null)->first();
    }

    public function findOldestTransaction() {
        $trans = $this->account()->transactions()->get();
        $tran = $trans->sortBy('timestamp')->first();
        return $tran;
    }
}
