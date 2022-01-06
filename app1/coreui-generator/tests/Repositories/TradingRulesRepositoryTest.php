<?php namespace Tests\Repositories;

use App\Models\TradingRules;
use App\Repositories\TradingRulesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TradingRulesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TradingRulesRepository
     */
    protected $tradingRulesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tradingRulesRepo = \App::make(TradingRulesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_trading_rules()
    {
        $tradingRules = TradingRules::factory()->make()->toArray();

        $createdTradingRules = $this->tradingRulesRepo->create($tradingRules);

        $createdTradingRules = $createdTradingRules->toArray();
        $this->assertArrayHasKey('id', $createdTradingRules);
        $this->assertNotNull($createdTradingRules['id'], 'Created TradingRules must have id specified');
        $this->assertNotNull(TradingRules::find($createdTradingRules['id']), 'TradingRules with given id must be in DB');
        $this->assertModelData($tradingRules, $createdTradingRules);
    }

    /**
     * @test read
     */
    public function test_read_trading_rules()
    {
        $tradingRules = TradingRules::factory()->create();

        $dbTradingRules = $this->tradingRulesRepo->find($tradingRules->id);

        $dbTradingRules = $dbTradingRules->toArray();
        $this->assertModelData($tradingRules->toArray(), $dbTradingRules);
    }

    /**
     * @test update
     */
    public function test_update_trading_rules()
    {
        $tradingRules = TradingRules::factory()->create();
        $fakeTradingRules = TradingRules::factory()->make()->toArray();

        $updatedTradingRules = $this->tradingRulesRepo->update($fakeTradingRules, $tradingRules->id);

        $this->assertModelData($fakeTradingRules, $updatedTradingRules->toArray());
        $dbTradingRules = $this->tradingRulesRepo->find($tradingRules->id);
        $this->assertModelData($fakeTradingRules, $dbTradingRules->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_trading_rules()
    {
        $tradingRules = TradingRules::factory()->create();

        $resp = $this->tradingRulesRepo->delete($tradingRules->id);

        $this->assertTrue($resp);
        $this->assertNull(TradingRules::find($tradingRules->id), 'TradingRules should not exist in DB');
    }
}
