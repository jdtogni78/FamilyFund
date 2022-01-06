<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MatchingRules;

class MatchingRulesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_matching_rules()
    {
        $matchingRules = MatchingRules::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/matching_rules', $matchingRules
        );

        $this->assertApiResponse($matchingRules);
    }

    /**
     * @test
     */
    public function test_read_matching_rules()
    {
        $matchingRules = MatchingRules::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/matching_rules/'.$matchingRules->id
        );

        $this->assertApiResponse($matchingRules->toArray());
    }

    /**
     * @test
     */
    public function test_update_matching_rules()
    {
        $matchingRules = MatchingRules::factory()->create();
        $editedMatchingRules = MatchingRules::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/matching_rules/'.$matchingRules->id,
            $editedMatchingRules
        );

        $this->assertApiResponse($editedMatchingRules);
    }

    /**
     * @test
     */
    public function test_delete_matching_rules()
    {
        $matchingRules = MatchingRules::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/matching_rules/'.$matchingRules->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/matching_rules/'.$matchingRules->id
        );

        $this->response->assertStatus(404);
    }
}
