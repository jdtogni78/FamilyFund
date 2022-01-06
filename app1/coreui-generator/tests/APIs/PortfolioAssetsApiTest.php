<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PortfolioAssets;

class PortfolioAssetsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_portfolio_assets()
    {
        $portfolioAssets = PortfolioAssets::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/portfolio_assets', $portfolioAssets
        );

        $this->assertApiResponse($portfolioAssets);
    }

    /**
     * @test
     */
    public function test_read_portfolio_assets()
    {
        $portfolioAssets = PortfolioAssets::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/portfolio_assets/'.$portfolioAssets->id
        );

        $this->assertApiResponse($portfolioAssets->toArray());
    }

    /**
     * @test
     */
    public function test_update_portfolio_assets()
    {
        $portfolioAssets = PortfolioAssets::factory()->create();
        $editedPortfolioAssets = PortfolioAssets::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/portfolio_assets/'.$portfolioAssets->id,
            $editedPortfolioAssets
        );

        $this->assertApiResponse($editedPortfolioAssets);
    }

    /**
     * @test
     */
    public function test_delete_portfolio_assets()
    {
        $portfolioAssets = PortfolioAssets::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/portfolio_assets/'.$portfolioAssets->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/portfolio_assets/'.$portfolioAssets->id
        );

        $this->response->assertStatus(404);
    }
}
