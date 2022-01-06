<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TradingRules;

class TradingRulesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_trading_rules()
    {
        $tradingRules = TradingRules::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/trading_rules', $tradingRules
        );

        $this->assertApiResponse($tradingRules);
    }

    /**
     * @test
     */
    public function test_read_trading_rules()
    {
        $tradingRules = TradingRules::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/trading_rules/'.$tradingRules->id
        );

        $this->assertApiResponse($tradingRules->toArray());
    }

    /**
     * @test
     */
    public function test_update_trading_rules()
    {
        $tradingRules = TradingRules::factory()->create();
        $editedTradingRules = TradingRules::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/trading_rules/'.$tradingRules->id,
            $editedTradingRules
        );

        $this->assertApiResponse($editedTradingRules);
    }

    /**
     * @test
     */
    public function test_delete_trading_rules()
    {
        $tradingRules = TradingRules::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/trading_rules/'.$tradingRules->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/trading_rules/'.$tradingRules->id
        );

        $this->response->assertStatus(404);
    }
}
