<?php namespace Tests\Repositories;

use App\Models\AccountTradingRule;
use App\Repositories\AccountTradingRuleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AccountTradingRuleRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AccountTradingRuleRepository
     */
    protected $accountTradingRuleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->accountTradingRuleRepo = \App::make(AccountTradingRuleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_account_trading_rule()
    {
        $accountTradingRule = AccountTradingRule::factory()->make()->toArray();

        $createdAccountTradingRule = $this->accountTradingRuleRepo->create($accountTradingRule);

        $createdAccountTradingRule = $createdAccountTradingRule->toArray();
        $this->assertArrayHasKey('id', $createdAccountTradingRule);
        $this->assertNotNull($createdAccountTradingRule['id'], 'Created AccountTradingRule must have id specified');
        $this->assertNotNull(AccountTradingRule::find($createdAccountTradingRule['id']), 'AccountTradingRule with given id must be in DB');
        $this->assertModelData($accountTradingRule, $createdAccountTradingRule);
    }

    /**
     * @test read
     */
    public function test_read_account_trading_rule()
    {
        $accountTradingRule = AccountTradingRule::factory()->create();

        $dbAccountTradingRule = $this->accountTradingRuleRepo->find($accountTradingRule->id);

        $dbAccountTradingRule = $dbAccountTradingRule->toArray();
        $this->assertModelData($accountTradingRule->toArray(), $dbAccountTradingRule);
    }

    /**
     * @test update
     */
    public function test_update_account_trading_rule()
    {
        $accountTradingRule = AccountTradingRule::factory()->create();
        $fakeAccountTradingRule = AccountTradingRule::factory()->make()->toArray();

        $updatedAccountTradingRule = $this->accountTradingRuleRepo->update($fakeAccountTradingRule, $accountTradingRule->id);

        $this->assertModelData($fakeAccountTradingRule, $updatedAccountTradingRule->toArray());
        $dbAccountTradingRule = $this->accountTradingRuleRepo->find($accountTradingRule->id);
        $this->assertModelData($fakeAccountTradingRule, $dbAccountTradingRule->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_account_trading_rule()
    {
        $accountTradingRule = AccountTradingRule::factory()->create();

        $resp = $this->accountTradingRuleRepo->delete($accountTradingRule->id);

        $this->assertTrue($resp);
        $this->assertNull(AccountTradingRule::find($accountTradingRule->id), 'AccountTradingRule should not exist in DB');
    }
}
