<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AccountTradingRules;

class AccountTradingRulesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_account_trading_rules()
    {
        $accountTradingRules = AccountTradingRules::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/account_trading_rules', $accountTradingRules
        );

        $this->assertApiResponse($accountTradingRules);
    }

    /**
     * @test
     */
    public function test_read_account_trading_rules()
    {
        $accountTradingRules = AccountTradingRules::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/account_trading_rules/'.$accountTradingRules->id
        );

        $this->assertApiResponse($accountTradingRules->toArray());
    }

    /**
     * @test
     */
    public function test_update_account_trading_rules()
    {
        $accountTradingRules = AccountTradingRules::factory()->create();
        $editedAccountTradingRules = AccountTradingRules::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/account_trading_rules/'.$accountTradingRules->id,
            $editedAccountTradingRules
        );

        $this->assertApiResponse($editedAccountTradingRules);
    }

    /**
     * @test
     */
    public function test_delete_account_trading_rules()
    {
        $accountTradingRules = AccountTradingRules::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/account_trading_rules/'.$accountTradingRules->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/account_trading_rules/'.$accountTradingRules->id
        );

        $this->response->assertStatus(404);
    }
}
