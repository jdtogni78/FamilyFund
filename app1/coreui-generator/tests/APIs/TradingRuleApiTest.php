<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TradingRule;

class TradingRuleApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_trading_rule()
    {
        $tradingRule = TradingRule::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/trading_rules', $tradingRule
        );

        $this->assertApiResponse($tradingRule);
    }

    /**
     * @test
     */
    public function test_read_trading_rule()
    {
        $tradingRule = TradingRule::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/trading_rules/'.$tradingRule->id
        );

        $this->assertApiResponse($tradingRule->toArray());
    }

    /**
     * @test
     */
    public function test_update_trading_rule()
    {
        $tradingRule = TradingRule::factory()->create();
        $editedTradingRule = TradingRule::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/trading_rules/'.$tradingRule->id,
            $editedTradingRule
        );

        $this->assertApiResponse($editedTradingRule);
    }

    /**
     * @test
     */
    public function test_delete_trading_rule()
    {
        $tradingRule = TradingRule::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/trading_rules/'.$tradingRule->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/trading_rules/'.$tradingRule->id
        );

        $this->response->assertStatus(404);
    }
}
