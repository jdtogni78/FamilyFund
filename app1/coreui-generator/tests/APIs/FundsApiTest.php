<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Funds;

class FundsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_funds()
    {
        $funds = Funds::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/funds', $funds
        );

        $this->assertApiResponse($funds);
    }

    /**
     * @test
     */
    public function test_read_funds()
    {
        $funds = Funds::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/funds/'.$funds->id
        );

        $this->assertApiResponse($funds->toArray());
    }

    /**
     * @test
     */
    public function test_update_funds()
    {
        $funds = Funds::factory()->create();
        $editedFunds = Funds::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/funds/'.$funds->id,
            $editedFunds
        );

        $this->assertApiResponse($editedFunds);
    }

    /**
     * @test
     */
    public function test_delete_funds()
    {
        $funds = Funds::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/funds/'.$funds->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/funds/'.$funds->id
        );

        $this->response->assertStatus(404);
    }
}
