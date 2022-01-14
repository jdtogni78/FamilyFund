<?php namespace Tests\Repositories;

use App\Models\TradingRule;
use App\Repositories\TradingRuleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TradingRuleRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TradingRuleRepository
     */
    protected $tradingRuleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tradingRuleRepo = \App::make(TradingRuleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_trading_rule()
    {
        $tradingRule = TradingRule::factory()->make()->toArray();

        $createdTradingRule = $this->tradingRuleRepo->create($tradingRule);

        $createdTradingRule = $createdTradingRule->toArray();
        $this->assertArrayHasKey('id', $createdTradingRule);
        $this->assertNotNull($createdTradingRule['id'], 'Created TradingRule must have id specified');
        $this->assertNotNull(TradingRule::find($createdTradingRule['id']), 'TradingRule with given id must be in DB');
        $this->assertModelData($tradingRule, $createdTradingRule);
    }

    /**
     * @test read
     */
    public function test_read_trading_rule()
    {
        $tradingRule = TradingRule::factory()->create();

        $dbTradingRule = $this->tradingRuleRepo->find($tradingRule->id);

        $dbTradingRule = $dbTradingRule->toArray();
        $this->assertModelData($tradingRule->toArray(), $dbTradingRule);
    }

    /**
     * @test update
     */
    public function test_update_trading_rule()
    {
        $tradingRule = TradingRule::factory()->create();
        $fakeTradingRule = TradingRule::factory()->make()->toArray();

        $updatedTradingRule = $this->tradingRuleRepo->update($fakeTradingRule, $tradingRule->id);

        $this->assertModelData($fakeTradingRule, $updatedTradingRule->toArray());
        $dbTradingRule = $this->tradingRuleRepo->find($tradingRule->id);
        $this->assertModelData($fakeTradingRule, $dbTradingRule->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_trading_rule()
    {
        $tradingRule = TradingRule::factory()->create();

        $resp = $this->tradingRuleRepo->delete($tradingRule->id);

        $this->assertTrue($resp);
        $this->assertNull(TradingRule::find($tradingRule->id), 'TradingRule should not exist in DB');
    }
}
