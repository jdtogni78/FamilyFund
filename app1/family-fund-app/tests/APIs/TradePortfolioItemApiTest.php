<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TradePortfolioItem;

class TradePortfolioItemApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_trade_portfolio_item()
    {
        $tradePortfolioItem = TradePortfolioItem::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/trade_portfolio_items', $tradePortfolioItem
        );

        $this->assertApiResponse($tradePortfolioItem);
    }

    /**
     * @test
     */
    public function test_read_trade_portfolio_item()
    {
        $tradePortfolioItem = TradePortfolioItem::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/trade_portfolio_items/'.$tradePortfolioItem->id
        );

        $this->assertApiResponse($tradePortfolioItem->toArray());
    }

    /**
     * @test
     */
    public function test_update_trade_portfolio_item()
    {
        $tradePortfolioItem = TradePortfolioItem::factory()->create();
        $editedTradePortfolioItem = TradePortfolioItem::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/trade_portfolio_items/'.$tradePortfolioItem->id,
            $editedTradePortfolioItem
        );

        $this->assertApiResponse($editedTradePortfolioItem);
    }

    /**
     * @test
     */
    public function test_delete_trade_portfolio_item()
    {
        $tradePortfolioItem = TradePortfolioItem::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/trade_portfolio_items/'.$tradePortfolioItem->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/trade_portfolio_items/'.$tradePortfolioItem->id
        );

        $this->response->assertStatus(404);
    }
}
