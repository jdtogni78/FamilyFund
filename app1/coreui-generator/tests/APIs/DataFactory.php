<?php namespace Tests\APIs;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Fund;
use App\Models\Portfolio;
use App\Models\Account;
use App\Models\AccountBalance;
use App\Models\MatchingRule;
use App\Models\AccountMatchingRule;

class DataFactory
{
    public $funds = array();
    public $users = array();
    public $matchings = array();

    public function setupFund($shares=1000, $value=1000)
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

        $cash = Assets::where('name', '=', 'CASH')->first();

        PortfolioAssets::factory()
            ->for($fund)
            ->for($cash)
            ->create([
                'shares' => $value
            ]);
        return $this->fund;
    }

    public function addUser() {
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

    public function addMatchingToUser() {
        return AccountMatchingRule::factory()
            ->for($this->userAccount, 'account')
            ->for($this->matching)
            ->create();
    }
    
    public function addTransaction($value=100, $type='PUR', $source='DIR') {
        $this->transaction = Transaction::factory()
            ->for($this->userAccount, 'account')
            ->make([
                'type' => $type,
                'source' => $source,
                'value' => $value
            ]);
        return $this->transaction;
    }
}
