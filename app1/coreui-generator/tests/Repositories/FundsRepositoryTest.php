<?php namespace Tests\Repositories;

use App\Models\Funds;
use App\Repositories\FundsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FundsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FundsRepository
     */
    protected $fundsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->fundsRepo = \App::make(FundsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_funds()
    {
        $funds = Funds::factory()->make()->toArray();

        $createdFunds = $this->fundsRepo->create($funds);

        $createdFunds = $createdFunds->toArray();
        $this->assertArrayHasKey('id', $createdFunds);
        $this->assertNotNull($createdFunds['id'], 'Created Funds must have id specified');
        $this->assertNotNull(Funds::find($createdFunds['id']), 'Funds with given id must be in DB');
        $this->assertModelData($funds, $createdFunds);
    }

    /**
     * @test read
     */
    public function test_read_funds()
    {
        $funds = Funds::factory()->create();

        $dbFunds = $this->fundsRepo->find($funds->id);

        $dbFunds = $dbFunds->toArray();
        $this->assertModelData($funds->toArray(), $dbFunds);
    }

    /**
     * @test update
     */
    public function test_update_funds()
    {
        $funds = Funds::factory()->create();
        $fakeFunds = Funds::factory()->make()->toArray();

        $updatedFunds = $this->fundsRepo->update($fakeFunds, $funds->id);

        $this->assertModelData($fakeFunds, $updatedFunds->toArray());
        $dbFunds = $this->fundsRepo->find($funds->id);
        $this->assertModelData($fakeFunds, $dbFunds->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_funds()
    {
        $funds = Funds::factory()->create();

        $resp = $this->fundsRepo->delete($funds->id);

        $this->assertTrue($resp);
        $this->assertNull(Funds::find($funds->id), 'Funds should not exist in DB');
    }
}
