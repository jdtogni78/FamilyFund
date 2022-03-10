<?php namespace Tests;

use App\Models\AssetExt;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Fund;
use App\Models\Portfolio;
use App\Models\Account;
use App\Models\AccountBalance;
use App\Models\Asset;
use App\Models\PortfolioAsset;
use App\Models\MatchingRule;
use App\Models\AccountMatchingRule;

class DataFactory
{
    public $funds = array();
    public $users = array();
    public $matchings = array();
    public $portfolio;
    public $fundAccount;
    public $fundTransaction;
    public $fundBalance;
    public $cashPosition;
    public $cash;

    public function createFund($shares=1000, $value=1000, $timestamp='2022-01-01')
    {
        $this->fund = Fund::factory()
            ->has(Portfolio::factory()->count(1), 'portfolios')
            ->has(Account::factory()->count(1), 'accounts')
            ->create();
        $this->funds[] = $this->fund;

        $this->fundAccount = $this->fund->account();
        $this->portfolio = $this->fund->portfolio();

        $this->fundTransaction = Transaction::factory()
            ->for($this->fundAccount, 'account')
            ->create();

        $this->fundBalance = AccountBalance::factory()
            ->for($this->fundTransaction, 'transaction')
            ->create([
                'type' => 'OWN',
                'shares' => $shares
            ]);

        $this->cash = AssetExt::getCashAsset()->first();

        $this->cashPosition = PortfolioAsset::factory()
            ->for($this->portfolio, 'portfolio')
            ->for($this->cash, 'asset')
            ->create([
                'position' => $value,
                'start_dt' => $timestamp,
            ]);
        return $this->fund;
    }

    public function createUser() {
        $this->user = User::factory()
            ->has(Account::factory()
                ->for($this->fund, 'fund')
                ->count(1), 'accounts')
            ->create();
        $this->userAccount = $this->user->accounts()->first();
        $this->users[] = $this->user;
        $this->userAccounts[] = $this->userAccount;
        return $this->user;
    }

    public function createMatching($limit=100, $match=100) {
        $this->matching = MatchingRule::factory()->create([
            'dollar_range_start' => 0,
            'dollar_range_end' => $limit,
            'match_percent' => $match
        ]);
        $this->matchings[] = $this->matching;
        return $this->matching;
    }

    public function createAccountMatching() {
        return AccountMatchingRule::factory()
            ->for($this->userAccount, 'account')
            ->for($this->matching)
            ->create();
    }

    public function createTransaction($value=100, $account=null, $type='PUR', $source='DIR') {
        $tran = $this->makeTransaction($value, $account, $type, $source);
        $tran->save();
        return $tran;
    }

    public function makeTransaction($value=100, $account=null, $type='PUR', $source='DIR') {
        if ($account == null) {
            if ($this->userAccount != null) {
                $account = $this->userAccount;
            } else {
                $account = $this->fundAccount;
            }
        }
        $this->transaction = Transaction::factory()
            ->for($account, 'account')
            ->make([
                'type' => $type,
                'source' => $source,
                'value' => $value
            ]);
        return $this->transaction;
    }

    public function createAsset($source)
    {
        return Asset::factory()->create([
            'source' => $source,
        ]);
    }
}
