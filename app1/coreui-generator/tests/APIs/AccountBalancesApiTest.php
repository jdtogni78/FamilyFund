<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AccountBalances;

class AccountBalancesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_account_balances()
    {
        $accountBalances = AccountBalances::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/account_balances', $accountBalances
        );

        $this->assertApiResponse($accountBalances);
    }

    /**
     * @test
     */
    public function test_read_account_balances()
    {
        $accountBalances = AccountBalances::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/account_balances/'.$accountBalances->id
        );

        $this->assertApiResponse($accountBalances->toArray());
    }

    /**
     * @test
     */
    public function test_update_account_balances()
    {
        $accountBalances = AccountBalances::factory()->create();
        $editedAccountBalances = AccountBalances::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/account_balances/'.$accountBalances->id,
            $editedAccountBalances
        );

        $this->assertApiResponse($editedAccountBalances);
    }

    /**
     * @test
     */
    public function test_delete_account_balances()
    {
        $accountBalances = AccountBalances::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/account_balances/'.$accountBalances->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/account_balances/'.$accountBalances->id
        );

        $this->response->assertStatus(404);
    }
}
