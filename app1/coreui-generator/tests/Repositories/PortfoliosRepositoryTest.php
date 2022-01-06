<?php namespace Tests\Repositories;

use App\Models\Portfolios;
use App\Repositories\PortfoliosRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PortfoliosRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PortfoliosRepository
     */
    protected $portfoliosRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->portfoliosRepo = \App::make(PortfoliosRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_portfolios()
    {
        $portfolios = Portfolios::factory()->make()->toArray();

        $createdPortfolios = $this->portfoliosRepo->create($portfolios);

        $createdPortfolios = $createdPortfolios->toArray();
        $this->assertArrayHasKey('id', $createdPortfolios);
        $this->assertNotNull($createdPortfolios['id'], 'Created Portfolios must have id specified');
        $this->assertNotNull(Portfolios::find($createdPortfolios['id']), 'Portfolios with given id must be in DB');
        $this->assertModelData($portfolios, $createdPortfolios);
    }

    /**
     * @test read
     */
    public function test_read_portfolios()
    {
        $portfolios = Portfolios::factory()->create();

        $dbPortfolios = $this->portfoliosRepo->find($portfolios->id);

        $dbPortfolios = $dbPortfolios->toArray();
        $this->assertModelData($portfolios->toArray(), $dbPortfolios);
    }

    /**
     * @test update
     */
    public function test_update_portfolios()
    {
        $portfolios = Portfolios::factory()->create();
        $fakePortfolios = Portfolios::factory()->make()->toArray();

        $updatedPortfolios = $this->portfoliosRepo->update($fakePortfolios, $portfolios->id);

        $this->assertModelData($fakePortfolios, $updatedPortfolios->toArray());
        $dbPortfolios = $this->portfoliosRepo->find($portfolios->id);
        $this->assertModelData($fakePortfolios, $dbPortfolios->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_portfolios()
    {
        $portfolios = Portfolios::factory()->create();

        $resp = $this->portfoliosRepo->delete($portfolios->id);

        $this->assertTrue($resp);
        $this->assertNull(Portfolios::find($portfolios->id), 'Portfolios should not exist in DB');
    }
}
