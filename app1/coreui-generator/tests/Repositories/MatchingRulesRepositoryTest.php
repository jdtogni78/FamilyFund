<?php namespace Tests\Repositories;

use App\Models\MatchingRules;
use App\Repositories\MatchingRulesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MatchingRulesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MatchingRulesRepository
     */
    protected $matchingRulesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->matchingRulesRepo = \App::make(MatchingRulesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_matching_rules()
    {
        $matchingRules = MatchingRules::factory()->make()->toArray();

        $createdMatchingRules = $this->matchingRulesRepo->create($matchingRules);

        $createdMatchingRules = $createdMatchingRules->toArray();
        $this->assertArrayHasKey('id', $createdMatchingRules);
        $this->assertNotNull($createdMatchingRules['id'], 'Created MatchingRules must have id specified');
        $this->assertNotNull(MatchingRules::find($createdMatchingRules['id']), 'MatchingRules with given id must be in DB');
        $this->assertModelData($matchingRules, $createdMatchingRules);
    }

    /**
     * @test read
     */
    public function test_read_matching_rules()
    {
        $matchingRules = MatchingRules::factory()->create();

        $dbMatchingRules = $this->matchingRulesRepo->find($matchingRules->id);

        $dbMatchingRules = $dbMatchingRules->toArray();
        $this->assertModelData($matchingRules->toArray(), $dbMatchingRules);
    }

    /**
     * @test update
     */
    public function test_update_matching_rules()
    {
        $matchingRules = MatchingRules::factory()->create();
        $fakeMatchingRules = MatchingRules::factory()->make()->toArray();

        $updatedMatchingRules = $this->matchingRulesRepo->update($fakeMatchingRules, $matchingRules->id);

        $this->assertModelData($fakeMatchingRules, $updatedMatchingRules->toArray());
        $dbMatchingRules = $this->matchingRulesRepo->find($matchingRules->id);
        $this->assertModelData($fakeMatchingRules, $dbMatchingRules->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_matching_rules()
    {
        $matchingRules = MatchingRules::factory()->create();

        $resp = $this->matchingRulesRepo->delete($matchingRules->id);

        $this->assertTrue($resp);
        $this->assertNull(MatchingRules::find($matchingRules->id), 'MatchingRules should not exist in DB');
    }
}
