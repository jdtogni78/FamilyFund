<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Accounts;

class AccountsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_accounts()
    {
        $accounts = Accounts::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/accounts', $accounts
        );

        $this->assertApiResponse($accounts);
    }

    /**
     * @test
     */
    public function test_read_accounts()
    {
        $accounts = Accounts::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/accounts/'.$accounts->id
        );

        $this->assertApiResponse($accounts->toArray());
    }

    /**
     * @test
     */
    public function test_update_accounts()
    {
        $accounts = Accounts::factory()->create();
        $editedAccounts = Accounts::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/accounts/'.$accounts->id,
            $editedAccounts
        );

        $this->assertApiResponse($editedAccounts);
    }

    /**
     * @test
     */
    public function test_delete_accounts()
    {
        $accounts = Accounts::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/accounts/'.$accounts->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/accounts/'.$accounts->id
        );

        $this->response->assertStatus(404);
    }
}
