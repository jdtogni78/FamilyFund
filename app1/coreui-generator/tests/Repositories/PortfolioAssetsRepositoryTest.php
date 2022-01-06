<?php namespace Tests\Repositories;

use App\Models\PortfolioAssets;
use App\Repositories\PortfolioAssetsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PortfolioAssetsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PortfolioAssetsRepository
     */
    protected $portfolioAssetsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->portfolioAssetsRepo = \App::make(PortfolioAssetsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_portfolio_assets()
    {
        $portfolioAssets = PortfolioAssets::factory()->make()->toArray();

        $createdPortfolioAssets = $this->portfolioAssetsRepo->create($portfolioAssets);

        $createdPortfolioAssets = $createdPortfolioAssets->toArray();
        $this->assertArrayHasKey('id', $createdPortfolioAssets);
        $this->assertNotNull($createdPortfolioAssets['id'], 'Created PortfolioAssets must have id specified');
        $this->assertNotNull(PortfolioAssets::find($createdPortfolioAssets['id']), 'PortfolioAssets with given id must be in DB');
        $this->assertModelData($portfolioAssets, $createdPortfolioAssets);
    }

    /**
     * @test read
     */
    public function test_read_portfolio_assets()
    {
        $portfolioAssets = PortfolioAssets::factory()->create();

        $dbPortfolioAssets = $this->portfolioAssetsRepo->find($portfolioAssets->id);

        $dbPortfolioAssets = $dbPortfolioAssets->toArray();
        $this->assertModelData($portfolioAssets->toArray(), $dbPortfolioAssets);
    }

    /**
     * @test update
     */
    public function test_update_portfolio_assets()
    {
        $portfolioAssets = PortfolioAssets::factory()->create();
        $fakePortfolioAssets = PortfolioAssets::factory()->make()->toArray();

        $updatedPortfolioAssets = $this->portfolioAssetsRepo->update($fakePortfolioAssets, $portfolioAssets->id);

        $this->assertModelData($fakePortfolioAssets, $updatedPortfolioAssets->toArray());
        $dbPortfolioAssets = $this->portfolioAssetsRepo->find($portfolioAssets->id);
        $this->assertModelData($fakePortfolioAssets, $dbPortfolioAssets->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_portfolio_assets()
    {
        $portfolioAssets = PortfolioAssets::factory()->create();

        $resp = $this->portfolioAssetsRepo->delete($portfolioAssets->id);

        $this->assertTrue($resp);
        $this->assertNull(PortfolioAssets::find($portfolioAssets->id), 'PortfolioAssets should not exist in DB');
    }
}
