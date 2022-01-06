<?php namespace Tests\Repositories;

use App\Models\AssetPrices;
use App\Repositories\AssetPricesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AssetPricesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AssetPricesRepository
     */
    protected $assetPricesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->assetPricesRepo = \App::make(AssetPricesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_asset_prices()
    {
        $assetPrices = AssetPrices::factory()->make()->toArray();

        $createdAssetPrices = $this->assetPricesRepo->create($assetPrices);

        $createdAssetPrices = $createdAssetPrices->toArray();
        $this->assertArrayHasKey('id', $createdAssetPrices);
        $this->assertNotNull($createdAssetPrices['id'], 'Created AssetPrices must have id specified');
        $this->assertNotNull(AssetPrices::find($createdAssetPrices['id']), 'AssetPrices with given id must be in DB');
        $this->assertModelData($assetPrices, $createdAssetPrices);
    }

    /**
     * @test read
     */
    public function test_read_asset_prices()
    {
        $assetPrices = AssetPrices::factory()->create();

        $dbAssetPrices = $this->assetPricesRepo->find($assetPrices->id);

        $dbAssetPrices = $dbAssetPrices->toArray();
        $this->assertModelData($assetPrices->toArray(), $dbAssetPrices);
    }

    /**
     * @test update
     */
    public function test_update_asset_prices()
    {
        $assetPrices = AssetPrices::factory()->create();
        $fakeAssetPrices = AssetPrices::factory()->make()->toArray();

        $updatedAssetPrices = $this->assetPricesRepo->update($fakeAssetPrices, $assetPrices->id);

        $this->assertModelData($fakeAssetPrices, $updatedAssetPrices->toArray());
        $dbAssetPrices = $this->assetPricesRepo->find($assetPrices->id);
        $this->assertModelData($fakeAssetPrices, $dbAssetPrices->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_asset_prices()
    {
        $assetPrices = AssetPrices::factory()->create();

        $resp = $this->assetPricesRepo->delete($assetPrices->id);

        $this->assertTrue($resp);
        $this->assertNull(AssetPrices::find($assetPrices->id), 'AssetPrices should not exist in DB');
    }
}
