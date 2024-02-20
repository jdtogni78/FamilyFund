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
    private mixed $resUsed = null;
    private mixed $resGranted = null;
    private mixed $resAvailable = null;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->date = '2022-01-01';
        $this->verbose = false;
//        $this->verbose = true;
    }

    public function testBasic()
    {
        $factory = new DataFactory();
        $factory->verbose = false;
        $factory->createFundWithMatching();

        $factory->transactions[0]->timestamp = $this->date;
        $factory->transactions[0]->save();
        $factory->transactions[1]->timestamp = $this->date;
        $factory->transactions[1]->save();

        $factory->matchTransaction->timestamp = $this->date;
        $factory->matchTransaction->save();

        $factory->matchingRule->date_start = '2021-02-03';
        $factory->matchingRule->save();

        $account = $factory->userAccount;

        if ($this->verbose) {
            print_r("tran1: " . json_encode($factory->transactions[0]) . "\n");
            print_r("match: " . json_encode($factory->matchTransaction) . "\n");
            print_r("\nAMR " . json_encode($amr = $account->accountMatchingRules()->first()));
            print_r("\nMR " . json_encode($amr->matchingRule()->first()));
            print_r("\n");
        }
//        $factory->dumpTransactions();
//        $factory->dumpMatchingRules();

        $this->getAPI($account);

        $this->assertCount(4, $this->data);
        $this->assertEquals($account->nickname, $this->data['nickname']);
        $this->assertCount(1, $this->resMR);
        $mr = $this->resMR[0];
        $this->assertEquals($factory->matchingRule->id, $mr['id']);
        $value = $factory->matchTransaction->value;

        $this->assertResponse(1, 50, 25, 50);

        // TODO: 2 tranMatchings
        $transaction = $factory->createTransaction(100, null, 'PUR', 'P', null, null);
        $transaction->timestamp = '2021-11-12';
        $transaction->save();

        $matching = $account->accountMatchingRules()->first();

        // lets pretend it maxed out
        $matchTransaction = $factory->createTransaction(25, null, 'MAT', 'C', null, null);
        $matchTransaction->timestamp = '2021-11-12';
        $matchTransaction->save();

        if ($this->verbose) {
            print_r("new tran: " . json_encode($transaction) . "\n");
            print_r("new match: " . json_encode($matchTransaction) . "\n");
        }
        $factory->createTransactionMatching($matching, $matchTransaction, $transaction);

        $this->getAPI($account);
        $this->assertResponse(1, 100, 50, 0);

        // TODO: 2 matchingRules
        $factory->createMatching(150, 100);
        $factory->matchingRule->date_start = '2021-02-03';
        $factory->matchingRule->save();

        $this->getAPI($account);
        $this->assertResponse(2, 100, 50, 0);
        $this->assertEquals(0, $this->resMR[1]['used']);
    }

    public function testNullObjects() {
        $factory = new DataFactory();
        $factory->createFund();
        $factory->createUser();
        $account = $factory->userAccount;
        $this->getAPI($account);
        $this->assertResponse(0, "NOT SET", "NOT SET", "NOT SET");

        $factory->createMatching(150, 100);
        $factory->matchingRule->date_start = '2021-02-03';
        $factory->matchingRule->save();
        $this->getAPI($account);
        $this->assertResponse(1, 0, 0, 150);

        $transaction = $factory->createTransaction(100, null, 'PUR', 'P', null, null);
        $transaction->timestamp = '2021-11-02';
        $transaction->save();

        $this->getAPI($account);
        $this->assertResponse(1, 0, 0, 150);

        $matching = $factory->userAccount->accountMatchingRules()->first();
        $value = $transaction->value;
        $matchTransaction = $factory->createTransaction($value, null, 'MAT', 'C', null, null);
        $matchTransaction->timestamp = '2021-11-02';
        $matchTransaction->save();

        if ($this->verbose) {
            print_r("new tran: " . json_encode($transaction) . "\n");
            print_r("new match: " . json_encode($matchTransaction) . "\n");
        }

        $this->getAPI($account);
        $this->assertResponse(1, 0, 0, 150);

        $factory->createTransactionMatching($matching, $matchTransaction, $transaction);
        $this->getAPI($account);
        $this->assertResponse(1, $value, $value, 150 - $value);
    }

    protected function getAPI(mixed $account, string $date=null): mixed
    {
        if ($date == null) $date = $this->date;
        $uri = '/api/account_matching/' . $account->id . '/as_of/' . $date;
        if ($this->verbose) print_r("\nuri: $uri\n");
        $this->response = $this->json(
            'GET',
            $uri
        );

        $this->assertApiSuccess();

        $response = json_decode($this->response->getContent(), true);
        if ($this->verbose) print_r("\nresponse: " . json_encode($response) . "\n");
        $this->data = $response['data'];
        $this->resMR = $response['data']['matching_rules'];
        if (count($this->resMR) > 0) {
            $this->resUsed = $this->resMR[0]['used'];
            $this->resGranted = $this->resMR[0]['granted'];
            $this->resAvailable = $this->resMR[0]['available'];
        } else {
            $this->resUsed = "NOT SET";
            $this->resGranted = "NOT SET";
            $this->resAvailable = "NOT SET";
        }
        return $response;
    }

    protected function assertResponse($count, $used, $granted, $available): void
    {
        $this->assertCount($count, $this->resMR);
        $this->assertEquals($granted, $this->resGranted);
        $this->assertEquals($available, $this->resAvailable);
        $this->assertEquals($used, $this->resUsed);
    }
}
