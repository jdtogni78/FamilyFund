<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Portfolios;

class PortfoliosApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_portfolios()
    {
        $portfolios = Portfolios::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/portfolios', $portfolios
        );

        $this->assertApiResponse($portfolios);
    }

    /**
     * @test
     */
    public function test_read_portfolios()
    {
        $portfolios = Portfolios::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/portfolios/'.$portfolios->id
        );

        $this->assertApiResponse($portfolios->toArray());
    }

    /**
     * @test
     */
    public function test_update_portfolios()
    {
        $portfolios = Portfolios::factory()->create();
        $editedPortfolios = Portfolios::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/portfolios/'.$portfolios->id,
            $editedPortfolios
        );

        $this->assertApiResponse($editedPortfolios);
    }

    /**
     * @test
     */
    public function test_delete_portfolios()
    {
        $portfolios = Portfolios::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/portfolios/'.$portfolios->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/portfolios/'.$portfolios->id
        );

        $this->response->assertStatus(404);
    }
}
