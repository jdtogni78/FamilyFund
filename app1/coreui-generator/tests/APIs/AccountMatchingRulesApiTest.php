<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AccountMatchingRules;

class AccountMatchingRulesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_account_matching_rules()
    {
        $accountMatchingRules = AccountMatchingRules::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/account_matching_rules', $accountMatchingRules
        );

        $this->assertApiResponse($accountMatchingRules);
    }

    /**
     * @test
     */
    public function test_read_account_matching_rules()
    {
        $accountMatchingRules = AccountMatchingRules::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/account_matching_rules/'.$accountMatchingRules->id
        );

        $this->assertApiResponse($accountMatchingRules->toArray());
    }

    /**
     * @test
     */
    public function test_update_account_matching_rules()
    {
        $accountMatchingRules = AccountMatchingRules::factory()->create();
        $editedAccountMatchingRules = AccountMatchingRules::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/account_matching_rules/'.$accountMatchingRules->id,
            $editedAccountMatchingRules
        );

        $this->assertApiResponse($editedAccountMatchingRules);
    }

    /**
     * @test
     */
    public function test_delete_account_matching_rules()
    {
        $accountMatchingRules = AccountMatchingRules::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/account_matching_rules/'.$accountMatchingRules->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/account_matching_rules/'.$accountMatchingRules->id
        );

        $this->response->assertStatus(404);
    }
}
