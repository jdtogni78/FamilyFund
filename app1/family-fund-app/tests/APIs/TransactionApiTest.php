<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\DataFactory;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Transaction;

class TransactionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_transaction()
    {
        $factory = new DataFactory();
        $factory->createFund();
        $factory->createUser();
        $transaction = $factory->makeTransaction()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/transactions', $transaction
        );

        $this->assertApiResponse($transaction);
    }

    /**
     * @test
     */
    public function test_create_transaction_error()
    {
        $factory = new DataFactory();
        $factory->createFund();
        $factory->createUser();
        $transaction = $factory->makeTransaction()->toArray();
        $transaction['type'] = '123';

        $this->response = $this->json(
            'POST',
            '/api/transactions', $transaction
        );

        $this->assertApiValidationError(422);
    }

    // /**
    //  * @test
    //  */
    // public function test_read_transaction()
    // {
    //     $transaction = Transaction::factory()->create();

    //     $this->response = $this->json(
    //         'GET',
    //         '/api/transactions/'.$transaction->id
    //     );

    //     $this->assertApiResponse($transaction->toArray());
    // }

    // /**
    //  * @test
    //  */
    // public function test_update_transaction()
    // {
    //     $transaction = Transaction::factory()->create();
    //     $editedTransaction = Transaction::factory()->make()->toArray();

    //     $this->response = $this->json(
    //         'PUT',
    //         '/api/transactions/'.$transaction->id,
    //         $editedTransaction
    //     );

    //     $this->assertApiResponse($editedTransaction);
    // }

    // /**
    //  * @test
    //  */
    // public function test_delete_transaction()
    // {
    //     $transaction = Transaction::factory()->create();

    //     $this->response = $this->json(
    //         'DELETE',
    //          '/api/transactions/'.$transaction->id
    //      );

    //     $this->assertApiSuccess();
    //     $this->response = $this->json(
    //         'GET',
    //         '/api/transactions/'.$transaction->id
    //     );

    //     $this->response->assertStatus(404);
    // }
}
