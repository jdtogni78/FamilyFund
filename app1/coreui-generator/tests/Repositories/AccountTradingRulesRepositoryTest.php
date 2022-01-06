<?php namespace Tests\Repositories;

use App\Models\AccountTradingRules;
use App\Repositories\AccountTradingRulesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AccountTradingRulesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AccountTradingRulesRepository
     */
    protected $accountTradingRulesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->accountTradingRulesRepo = \App::make(AccountTradingRulesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_account_trading_rules()
    {
        $accountTradingRules = AccountTradingRules::factory()->make()->toArray();

        $createdAccountTradingRules = $this->accountTradingRulesRepo->create($accountTradingRules);

        $createdAccountTradingRules = $createdAccountTradingRules->toArray();
        $this->assertArrayHasKey('id', $createdAccountTradingRules);
        $this->assertNotNull($createdAccountTradingRules['id'], 'Created AccountTradingRules must have id specified');
        $this->assertNotNull(AccountTradingRules::find($createdAccountTradingRules['id']), 'AccountTradingRules with given id must be in DB');
        $this->assertModelData($accountTradingRules, $createdAccountTradingRules);
    }

    /**
     * @test read
     */
    public function test_read_account_trading_rules()
    {
        $accountTradingRules = AccountTradingRules::factory()->create();

        $dbAccountTradingRules = $this->accountTradingRulesRepo->find($accountTradingRules->id);

        $dbAccountTradingRules = $dbAccountTradingRules->toArray();
        $this->assertModelData($accountTradingRules->toArray(), $dbAccountTradingRules);
    }

    /**
     * @test update
     */
    public function test_update_account_trading_rules()
    {
        $accountTradingRules = AccountTradingRules::factory()->create();
        $fakeAccountTradingRules = AccountTradingRules::factory()->make()->toArray();

        $updatedAccountTradingRules = $this->accountTradingRulesRepo->update($fakeAccountTradingRules, $accountTradingRules->id);

        $this->assertModelData($fakeAccountTradingRules, $updatedAccountTradingRules->toArray());
        $dbAccountTradingRules = $this->accountTradingRulesRepo->find($accountTradingRules->id);
        $this->assertModelData($fakeAccountTradingRules, $dbAccountTradingRules->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_account_trading_rules()
    {
        $accountTradingRules = AccountTradingRules::factory()->create();

        $resp = $this->accountTradingRulesRepo->delete($accountTradingRules->id);

        $this->assertTrue($resp);
        $this->assertNull(AccountTradingRules::find($accountTradingRules->id), 'AccountTradingRules should not exist in DB');
    }
}
