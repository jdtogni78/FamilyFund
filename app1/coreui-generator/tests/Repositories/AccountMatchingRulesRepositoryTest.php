<?php namespace Tests\Repositories;

use App\Models\AccountMatchingRules;
use App\Repositories\AccountMatchingRulesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AccountMatchingRulesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AccountMatchingRulesRepository
     */
    protected $accountMatchingRulesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->accountMatchingRulesRepo = \App::make(AccountMatchingRulesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_account_matching_rules()
    {
        $accountMatchingRules = AccountMatchingRules::factory()->make()->toArray();

        $createdAccountMatchingRules = $this->accountMatchingRulesRepo->create($accountMatchingRules);

        $createdAccountMatchingRules = $createdAccountMatchingRules->toArray();
        $this->assertArrayHasKey('id', $createdAccountMatchingRules);
        $this->assertNotNull($createdAccountMatchingRules['id'], 'Created AccountMatchingRules must have id specified');
        $this->assertNotNull(AccountMatchingRules::find($createdAccountMatchingRules['id']), 'AccountMatchingRules with given id must be in DB');
        $this->assertModelData($accountMatchingRules, $createdAccountMatchingRules);
    }

    /**
     * @test read
     */
    public function test_read_account_matching_rules()
    {
        $accountMatchingRules = AccountMatchingRules::factory()->create();

        $dbAccountMatchingRules = $this->accountMatchingRulesRepo->find($accountMatchingRules->id);

        $dbAccountMatchingRules = $dbAccountMatchingRules->toArray();
        $this->assertModelData($accountMatchingRules->toArray(), $dbAccountMatchingRules);
    }

    /**
     * @test update
     */
    public function test_update_account_matching_rules()
    {
        $accountMatchingRules = AccountMatchingRules::factory()->create();
        $fakeAccountMatchingRules = AccountMatchingRules::factory()->make()->toArray();

        $updatedAccountMatchingRules = $this->accountMatchingRulesRepo->update($fakeAccountMatchingRules, $accountMatchingRules->id);

        $this->assertModelData($fakeAccountMatchingRules, $updatedAccountMatchingRules->toArray());
        $dbAccountMatchingRules = $this->accountMatchingRulesRepo->find($accountMatchingRules->id);
        $this->assertModelData($fakeAccountMatchingRules, $dbAccountMatchingRules->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_account_matching_rules()
    {
        $accountMatchingRules = AccountMatchingRules::factory()->create();

        $resp = $this->accountMatchingRulesRepo->delete($accountMatchingRules->id);

        $this->assertTrue($resp);
        $this->assertNull(AccountMatchingRules::find($accountMatchingRules->id), 'AccountMatchingRules should not exist in DB');
    }
}
