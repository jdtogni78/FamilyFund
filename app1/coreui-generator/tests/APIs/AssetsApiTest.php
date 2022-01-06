<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Assets;

class AssetsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_assets()
    {
        $assets = Assets::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/assets', $assets
        );

        $this->assertApiResponse($assets);
    }

    /**
     * @test
     */
    public function test_read_assets()
    {
        $assets = Assets::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/assets/'.$assets->id
        );

        $this->assertApiResponse($assets->toArray());
    }

    /**
     * @test
     */
    public function test_update_assets()
    {
        $assets = Assets::factory()->create();
        $editedAssets = Assets::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/assets/'.$assets->id,
            $editedAssets
        );

        $this->assertApiResponse($editedAssets);
    }

    /**
     * @test
     */
    public function test_delete_assets()
    {
        $assets = Assets::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/assets/'.$assets->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/assets/'.$assets->id
        );

        $this->response->assertStatus(404);
    }
}
