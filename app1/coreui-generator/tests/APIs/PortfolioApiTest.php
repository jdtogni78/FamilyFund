<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Portfolio;

class PortfolioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_portfolio()
    {
        $portfolio = Portfolio::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/portfolios', $portfolio
        );

        $this->assertApiResponse($portfolio);
    }

    /**
     * @test
     */
    public function test_read_portfolio()
    {
        $portfolio = Portfolio::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/portfolios/'.$portfolio->id
        );

        $this->assertApiResponse($portfolio->toArray());
    }

    /**
     * @test
     */
    public function test_update_portfolio()
    {
        $portfolio = Portfolio::factory()->create();
        $editedPortfolio = Portfolio::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/portfolios/'.$portfolio->id,
            $editedPortfolio
        );

        $this->assertApiResponse($editedPortfolio);
    }

    /**
     * @test
     */
    public function test_delete_portfolio()
    {
        $portfolio = Portfolio::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/portfolios/'.$portfolio->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/portfolios/'.$portfolio->id
        );

        $this->response->assertStatus(404);
    }
}
