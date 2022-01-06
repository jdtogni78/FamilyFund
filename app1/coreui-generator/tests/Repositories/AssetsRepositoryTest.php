<?php namespace Tests\Repositories;

use App\Models\Assets;
use App\Repositories\AssetsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AssetsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AssetsRepository
     */
    protected $assetsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->assetsRepo = \App::make(AssetsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_assets()
    {
        $assets = Assets::factory()->make()->toArray();

        $createdAssets = $this->assetsRepo->create($assets);

        $createdAssets = $createdAssets->toArray();
        $this->assertArrayHasKey('id', $createdAssets);
        $this->assertNotNull($createdAssets['id'], 'Created Assets must have id specified');
        $this->assertNotNull(Assets::find($createdAssets['id']), 'Assets with given id must be in DB');
        $this->assertModelData($assets, $createdAssets);
    }

    /**
     * @test read
     */
    public function test_read_assets()
    {
        $assets = Assets::factory()->create();

        $dbAssets = $this->assetsRepo->find($assets->id);

        $dbAssets = $dbAssets->toArray();
        $this->assertModelData($assets->toArray(), $dbAssets);
    }

    /**
     * @test update
     */
    public function test_update_assets()
    {
        $assets = Assets::factory()->create();
        $fakeAssets = Assets::factory()->make()->toArray();

        $updatedAssets = $this->assetsRepo->update($fakeAssets, $assets->id);

        $this->assertModelData($fakeAssets, $updatedAssets->toArray());
        $dbAssets = $this->assetsRepo->find($assets->id);
        $this->assertModelData($fakeAssets, $dbAssets->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_assets()
    {
        $assets = Assets::factory()->create();

        $resp = $this->assetsRepo->delete($assets->id);

        $this->assertTrue($resp);
        $this->assertNull(Assets::find($assets->id), 'Assets should not exist in DB');
    }
}
