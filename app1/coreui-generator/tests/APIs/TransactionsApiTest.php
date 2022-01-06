<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Transactions;

class TransactionsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_transactions()
    {
        $transactions = Transactions::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/transactions', $transactions
        );

        $this->assertApiResponse($transactions);
    }

    /**
     * @test
     */
    public function test_read_transactions()
    {
        $transactions = Transactions::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/transactions/'.$transactions->id
        );

        $this->assertApiResponse($transactions->toArray());
    }

    /**
     * @test
     */
    public function test_update_transactions()
    {
        $transactions = Transactions::factory()->create();
        $editedTransactions = Transactions::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/transactions/'.$transactions->id,
            $editedTransactions
        );

        $this->assertApiResponse($editedTransactions);
    }

    /**
     * @test
     */
    public function test_delete_transactions()
    {
        $transactions = Transactions::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/transactions/'.$transactions->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/transactions/'.$transactions->id
        );

        $this->response->assertStatus(404);
    }
}
