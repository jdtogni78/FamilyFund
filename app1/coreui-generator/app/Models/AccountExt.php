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
    public function fund()
    {
        return parent::fund()->get()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function transactions()
    {
        return $this->hasMany(\App\Models\TransactionExt::class, 'account_id')->orderBy('created_at')->orderBy('matching_rule_id');
    }

    /**
     **/
    public function allSharesAsOf($now)
    {
        $accountBalanceRepo = \App::make(AccountBalanceRepository::class);
        $query = $accountBalanceRepo->makeModel()->newQuery();
        $query->where('account_id', $this->id);
        $query->whereDate('start_dt', '<=', $now);
        $query->whereDate('end_dt', '>', $now);
        $accountBalances = $query->get(['*']);
        $typeCount = array();
        $typeCount['OWN'] = 0;
        $typeCount['BOR'] = 0;
        foreach ($accountBalances as $balance) {
            $typeCount[$balance->type]++;
        }
        foreach ($typeCount as $key => $count) {
            if ($count > 1) {
                throw new \Exception("Every account can have only 1 balance active at any given day (found " . $count . ")");
            }
        }
        return $accountBalances;
    }

    public function ownedSharesAsOf($now) {
        $accountBalances = $this->allSharesAsOf($now);
        foreach ($accountBalances as $balance) {
            if ($balance->type == 'OWN') {
                return $balance->shares;
            }
        }
        return 0;
    }

    public function valueAsOf($now) {
        $shareValue = $this->fund()->shareValueAsOf($now);
        $shares = $this->ownedSharesAsOf($now);
        $value = $shareValue * $shares;
        return $value;
    }

    public function remainingMatchings() { 
        return NULL; 
    }

    public function periodPerformance($from, $to)
    {
        $shareValueFrom = $this->fund()->shareValueAsOf($from);
        $shareValueTo = $this->fund()->shareValueAsOf($to);
        
        $sharesFrom = $this->ownedSharesAsOf($from);
        $sharesTo = $this->ownedSharesAsOf($to);
        
        $valueFrom = $shareValueFrom * $sharesFrom;
        $valueTo = $shareValueTo * $sharesTo;

        // var_dump(array($from, $to, $shareValueFrom, $shareValueTo, $sharesFrom, $sharesTo, $valueFrom, $valueTo));
        if ($valueFrom == 0) return 0;
        return $valueTo/$valueFrom - 1;
    }

    public function yearlyPerformance($year)
    {
        $from = $year.'-01-01';
        $to = ($year+1).'-01-01';
        return $this->periodPerformance($from, $to);
    }}
