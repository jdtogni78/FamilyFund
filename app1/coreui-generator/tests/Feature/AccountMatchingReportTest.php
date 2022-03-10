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

    public function testBasic()
    {
        $factory = new DataFactory();
        $factory->createFundWithMatching();
        $account = $factory->userAccounts[0];
        $date = '2022-01-01';

        $this->response = $this->json(
            'GET',
            '/api/account_matching/'.$account->id.'/as_of/' . $date
        );

        $this->assertApiSuccess();

        $response = json_decode($this->response->getContent(), true);
        print_r("response: " . json_encode($response) . "\n");
        $data = $response['data'];

        $this->assertCount(2, $data);
        $this->assertEquals($account->nickname, $data['nickname']);
        $mrs = $data['matching_rules'];
        $this->assertCount(1, $mrs);
        $mr = $mrs[0];
        $this->assertEquals($factory->matchingRule->id, $mr['id']);
        $this->assertEquals($factory->matchTransaction->value, $mr['used']);
    }
}
