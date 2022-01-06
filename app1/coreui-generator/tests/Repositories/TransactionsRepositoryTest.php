<?php namespace Tests\Repositories;

use App\Models\Transactions;
use App\Repositories\TransactionsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TransactionsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TransactionsRepository
     */
    protected $transactionsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->transactionsRepo = \App::make(TransactionsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_transactions()
    {
        $transactions = Transactions::factory()->make()->toArray();

        $createdTransactions = $this->transactionsRepo->create($transactions);

        $createdTransactions = $createdTransactions->toArray();
        $this->assertArrayHasKey('id', $createdTransactions);
        $this->assertNotNull($createdTransactions['id'], 'Created Transactions must have id specified');
        $this->assertNotNull(Transactions::find($createdTransactions['id']), 'Transactions with given id must be in DB');
        $this->assertModelData($transactions, $createdTransactions);
    }

    /**
     * @test read
     */
    public function test_read_transactions()
    {
        $transactions = Transactions::factory()->create();

        $dbTransactions = $this->transactionsRepo->find($transactions->id);

        $dbTransactions = $dbTransactions->toArray();
        $this->assertModelData($transactions->toArray(), $dbTransactions);
    }

    /**
     * @test update
     */
    public function test_update_transactions()
    {
        $transactions = Transactions::factory()->create();
        $fakeTransactions = Transactions::factory()->make()->toArray();

        $updatedTransactions = $this->transactionsRepo->update($fakeTransactions, $transactions->id);

        $this->assertModelData($fakeTransactions, $updatedTransactions->toArray());
        $dbTransactions = $this->transactionsRepo->find($transactions->id);
        $this->assertModelData($fakeTransactions, $dbTransactions->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_transactions()
    {
        $transactions = Transactions::factory()->create();

        $resp = $this->transactionsRepo->delete($transactions->id);

        $this->assertTrue($resp);
        $this->assertNull(Transactions::find($transactions->id), 'Transactions should not exist in DB');
    }
}
