<?php namespace Tests\Repositories;

use App\Models\AccountBalances;
use App\Repositories\AccountBalancesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AccountBalancesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AccountBalancesRepository
     */
    protected $accountBalancesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->accountBalancesRepo = \App::make(AccountBalancesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_account_balances()
    {
        $accountBalances = AccountBalances::factory()->make()->toArray();

        $createdAccountBalances = $this->accountBalancesRepo->create($accountBalances);

        $createdAccountBalances = $createdAccountBalances->toArray();
        $this->assertArrayHasKey('id', $createdAccountBalances);
        $this->assertNotNull($createdAccountBalances['id'], 'Created AccountBalances must have id specified');
        $this->assertNotNull(AccountBalances::find($createdAccountBalances['id']), 'AccountBalances with given id must be in DB');
        $this->assertModelData($accountBalances, $createdAccountBalances);
    }

    /**
     * @test read
     */
    public function test_read_account_balances()
    {
        $accountBalances = AccountBalances::factory()->create();

        $dbAccountBalances = $this->accountBalancesRepo->find($accountBalances->id);

        $dbAccountBalances = $dbAccountBalances->toArray();
        $this->assertModelData($accountBalances->toArray(), $dbAccountBalances);
    }

    /**
     * @test update
     */
    public function test_update_account_balances()
    {
        $accountBalances = AccountBalances::factory()->create();
        $fakeAccountBalances = AccountBalances::factory()->make()->toArray();

        $updatedAccountBalances = $this->accountBalancesRepo->update($fakeAccountBalances, $accountBalances->id);

        $this->assertModelData($fakeAccountBalances, $updatedAccountBalances->toArray());
        $dbAccountBalances = $this->accountBalancesRepo->find($accountBalances->id);
        $this->assertModelData($fakeAccountBalances, $dbAccountBalances->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_account_balances()
    {
        $accountBalances = AccountBalances::factory()->create();

        $resp = $this->accountBalancesRepo->delete($accountBalances->id);

        $this->assertTrue($resp);
        $this->assertNull(AccountBalances::find($accountBalances->id), 'AccountBalances should not exist in DB');
    }
}
