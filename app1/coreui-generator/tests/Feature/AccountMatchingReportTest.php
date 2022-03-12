<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Tests\DataFactory;

class AccountMatchingReportTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    public $date;
    private mixed $resMR;
    private mixed $resUsed;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->date = '2022-01-01';
        $this->verbose = false;
    }

    public function testBasic()
    {
        $factory = new DataFactory();
        $factory->createFundWithMatching();
        $account = $factory->userAccount;

        $this->getAPI($account);

        $this->assertCount(2, $this->data);
        $this->assertEquals($account->nickname, $this->data['nickname']);
        $this->assertCount(1, $this->resMR);
        $mr = $this->resMR[0];
        $this->assertEquals($factory->matchingRule->id, $mr['id']);
        $value = $factory->matchTransaction->value;
        $this->assertEquals($value, $this->resUsed);

        // TODO: 2 tranMatchings
        $transaction = $factory->transactions[0];
        $matching = $account->accountMatchingRules()->first();
        $matchTransaction = $factory->createTransaction($value/2, null, 'DIR', 'MAT');
        $factory->createTransactionMatching($matching, $matchTransaction, $transaction);

        $this->getAPI($account);
        $this->assertResponse(1, $value + $value/2);

        // TODO: 2 matchingRules
        $factory->createMatchingRule(150, 100);
        $factory->createAccountMatching();
        $this->getAPI($account);
        $this->assertResponse(2, $value + $value/2);
        $this->assertEquals(0, $this->resMR[1]['used']);
    }

    public function testNullObjects() {
        $factory = new DataFactory();
        $factory->createFund();
        $factory->createUser();
        $account = $factory->userAccount;
        $this->getAPI($account);
        $this->assertResponse(0, "NOT SET");

        $factory->createMatchingRule(150, 100);
        $factory->createAccountMatching();
        $this->getAPI($account);
        $this->assertResponse(1, 0);

        $transaction = $factory->createTransaction();
        $this->getAPI($account);
        $this->assertResponse(1, 0);

        $matching = $factory->userAccount->accountMatchingRules()->first();
        $value = $transaction->value;
        $matchTransaction = $factory->createTransaction($value /2, null, 'DIR', 'MAT');
        $this->getAPI($account);
        $this->assertResponse(1, 0);

        $factory->createTransactionMatching($matching, $matchTransaction, $transaction);
        $this->getAPI($account);
        $this->assertResponse(1, $value/2);
    }

    protected function getAPI(mixed $account, string $date=null): mixed
    {
        if ($date == null) $date = $this->date;
        $this->response = $this->json(
            'GET',
            '/api/account_matching/' . $account->id . '/as_of/' . $date
        );

        $this->assertApiSuccess();

        $response = json_decode($this->response->getContent(), true);
        if ($this->verbose) print_r("response: " . json_encode($response) . "\n");
        $this->data = $response['data'];
        $this->resMR= $response['data']['matching_rules'];
        if (count($this->resMR) > 0)
            $this->resUsed = $this->resMR[0]['used'];
        else
            $this->resUsed = "NOT SET";
        return $response;
    }

    protected function assertResponse($count, $used): void
    {
        $this->assertCount($count, $this->resMR);
        $this->assertEquals($used, $this->resUsed);
    }
}
