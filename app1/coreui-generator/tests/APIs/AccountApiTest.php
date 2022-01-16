<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Account;
use App\Models\Fund;

class AccountApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_account()
    {
        $fund = Fund::factory()->create();
        $account = Account::factory()->make(
            ['fund_id' => $fund->id])->toArray();

        $this->response = $this->json(
            'POST',
            '/api/accounts', $account
        );

        $this->assertApiResponse($account);
    }

    public function createAccount()
    {
        $fund = FundApiTest::createFund();
        $account = $fund->accounts()->first();
        return $account;
    }
    /**
     * @test
     */
    public function test_read_account()
    {
        $account = $this->createAccount();

        $this->response = $this->json(
            'GET',
            '/api/accounts/'.$account->id
        );

        $this->assertApiResponse($account->toArray());
    }

    /**
     * @test
     */
    public function test_update_account()
    {
        $account = $this->createAccount();
        $fund = $account->fund()->first();
        $editedAccount = Account::factory()->make(
            ['fund_id' => $fund->id])->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/accounts/'.$account->id,
            $editedAccount
        );

        $this->assertApiResponse($editedAccount);
    }

    /**
     * @test
     */
    public function test_delete_account()
    {
        $fund = FundApiTest::createFund();
        $account = $fund->accounts()->first();

        $this->response = $this->json(
            'DELETE',
             '/api/accounts/'.$account->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/accounts/'.$account->id
        );

        $this->response->assertStatus(404);
    }
}
