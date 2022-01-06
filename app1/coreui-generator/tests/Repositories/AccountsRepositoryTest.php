<?php namespace Tests\Repositories;

use App\Models\Accounts;
use App\Repositories\AccountsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AccountsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AccountsRepository
     */
    protected $accountsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->accountsRepo = \App::make(AccountsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_accounts()
    {
        $accounts = Accounts::factory()->make()->toArray();

        $createdAccounts = $this->accountsRepo->create($accounts);

        $createdAccounts = $createdAccounts->toArray();
        $this->assertArrayHasKey('id', $createdAccounts);
        $this->assertNotNull($createdAccounts['id'], 'Created Accounts must have id specified');
        $this->assertNotNull(Accounts::find($createdAccounts['id']), 'Accounts with given id must be in DB');
        $this->assertModelData($accounts, $createdAccounts);
    }

    /**
     * @test read
     */
    public function test_read_accounts()
    {
        $accounts = Accounts::factory()->create();

        $dbAccounts = $this->accountsRepo->find($accounts->id);

        $dbAccounts = $dbAccounts->toArray();
        $this->assertModelData($accounts->toArray(), $dbAccounts);
    }

    /**
     * @test update
     */
    public function test_update_accounts()
    {
        $accounts = Accounts::factory()->create();
        $fakeAccounts = Accounts::factory()->make()->toArray();

        $updatedAccounts = $this->accountsRepo->update($fakeAccounts, $accounts->id);

        $this->assertModelData($fakeAccounts, $updatedAccounts->toArray());
        $dbAccounts = $this->accountsRepo->find($accounts->id);
        $this->assertModelData($fakeAccounts, $dbAccounts->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_accounts()
    {
        $accounts = Accounts::factory()->create();

        $resp = $this->accountsRepo->delete($accounts->id);

        $this->assertTrue($resp);
        $this->assertNull(Accounts::find($accounts->id), 'Accounts should not exist in DB');
    }
}
