<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AccountTradingRule;

class AccountTradingRuleApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_account_trading_rule()
    {
        $accountTradingRule = AccountTradingRule::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/account_trading_rules', $accountTradingRule
        );

        $this->assertApiResponse($accountTradingRule);
    }

    /**
     * @test
     */
    public function test_read_account_trading_rule()
    {
        $accountTradingRule = AccountTradingRule::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/account_trading_rules/'.$accountTradingRule->id
        );

        $this->assertApiResponse($accountTradingRule->toArray());
    }

    /**
     * @test
     */
    public function test_update_account_trading_rule()
    {
        $accountTradingRule = AccountTradingRule::factory()->create();
        $editedAccountTradingRule = AccountTradingRule::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/account_trading_rules/'.$accountTradingRule->id,
            $editedAccountTradingRule
        );

        $this->assertApiResponse($editedAccountTradingRule);
    }

    /**
     * @test
     */
    public function test_delete_account_trading_rule()
    {
        $accountTradingRule = AccountTradingRule::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/account_trading_rules/'.$accountTradingRule->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/account_trading_rules/'.$accountTradingRule->id
        );

        $this->response->assertStatus(404);
    }
}
