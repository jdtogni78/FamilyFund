<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Account;
use App\Models\Fund;
use App\Models\Portfolio;
use App\Models\AccountExt;
use App\Models\PortfolioExt;

class FundApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_fund()
    {
        $fund = Fund::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/funds', $fund
        );

        $this->assertApiResponse($fund);
    }

    /**
     * @test
     */
    public function test_read_fund()
    {
        $fund = (new DataFactory())->setupFund();

        $this->response = $this->json(
            'GET',
            '/api/funds/'.$fund->id
        );

        $this->assertApiResponse($fund->toArray());
    }

    /**
     * @test
     */
    public function test_update_fund()
    {
        $fund = Fund::factory()->create();
        $editedFund = Fund::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/funds/'.$fund->id,
            $editedFund
        );

        $this->assertApiResponse($editedFund);
    }

    /**
     * @test
     */
    public function test_delete_fund()
    {
        $fund = Fund::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/funds/'.$fund->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/funds/'.$fund->id
        );

        $this->response->assertStatus(404);
    }
}
