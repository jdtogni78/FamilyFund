<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AssetPrices;

class AssetPricesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_asset_prices()
    {
        $assetPrices = AssetPrices::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/asset_prices', $assetPrices
        );

        $this->assertApiResponse($assetPrices);
    }

    /**
     * @test
     */
    public function test_read_asset_prices()
    {
        $assetPrices = AssetPrices::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/asset_prices/'.$assetPrices->id
        );

        $this->assertApiResponse($assetPrices->toArray());
    }

    /**
     * @test
     */
    public function test_update_asset_prices()
    {
        $assetPrices = AssetPrices::factory()->create();
        $editedAssetPrices = AssetPrices::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/asset_prices/'.$assetPrices->id,
            $editedAssetPrices
        );

        $this->assertApiResponse($editedAssetPrices);
    }

    /**
     * @test
     */
    public function test_delete_asset_prices()
    {
        $assetPrices = AssetPrices::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/asset_prices/'.$assetPrices->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/asset_prices/'.$assetPrices->id
        );

        $this->response->assertStatus(404);
    }
}
