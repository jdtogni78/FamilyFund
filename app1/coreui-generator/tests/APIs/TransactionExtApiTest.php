<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Fund;
use App\Models\Portfolio;
use App\Models\Account;
use App\Models\AccountBalance;
use App\Models\MatchingRule;
use App\Models\AccountMatchingRule;

class TransactionExtApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    public function postTransaction($transaction)
    {
        $tranArr = $transaction->toArray();

        $this->response = $this->json(
            'POST',
            '/api/transactions', $tranArr
        );

        print_r($this->response->getContent());
        $this->assertApiResponse($tranArr);
    }

    public function validateTransaction($tran, $transaction, $value, $balance, $hasMatching=false)
    {
        $this->assertEquals($tran->value, $value);
        $this->assertEquals($tran->value, $transaction->value);
        $this->assertNull($tran->shares);

        if ($hasMatching) {
            $this->assertNull($tran->matching_id);
        } else {
            $this->assertNotNull($tran->matching_id);
        }

        $balance = $tran->accountBalances()->first();
        $this->assertNotNull($balance);
        print_r($balance->toArray());
        $this->assertEquals($balance->shares, $balance);
    }

    /**
     * @test
     */
    public function test_transactions()
    {
        $data = [
            [
                'fund' => ['shares' => 100000, 'value' => 1000],
                'match' => ['limit' => 150, 'match' => 100],
                'trans' => [
                    ['value' => 100, 'balance' => 10000, 'match' => ['value' => 100, 'balance' => 20000]],
                    ['value' => 100, 'balance' => 30000, 'match' => ['value' =>  50, 'balance' => 35000]],
                ],
            ],
            [
                'fund' => ['shares' => 100000, 'value' => 1000],
                'trans' => [
                    ['value' => 100, 'balance' => 10000],
                    ['value' => 100, 'balance' => 20000],
                ],
            ],
        ];

        foreach ($data as $d) {
            DB::beginTransaction();
            $this->test_create_transaction($d);
            DB::rollBack();
        }
    }

    public function test_create_transaction($data)
    {
        $factory = new DataFactory();
        
        $fund = $factory->setupFund($data->fundShares, $data->fundValue);
        $user = $factory->addUser();
        if ($data->match) {
            $matching = $factory->createMatching($data->match->limit, $data->match->match);
            $factory->addMatchingToUser();
        }

        foreach($data->trans as $dtran) {
            $transaction = $factory->addTransaction($dtran->value);
            $this->postTransaction($transaction);
    
            $tran = Transactions::find($this->response->getContent()->id);
            $this->assertNotNull($tran);
            print_r($tran->toArray());
    
            $this->validateTransaction($tran, $transaction, $dtran->value, $dtran->balance);
    
            if ($data->match) {
                $matchTran = $tran->transaction_matchings()->first();
                print_r($matchTran->toArray());
                $this->validateTransaction($matchTran, $transaction, $dtran->matchValue, $dtran->matchBalance);
            }
        }
    }

    public function test_create_fund_transaction($data) {
        $data = [
            [
                'fund' => ['shares' => 100000, 'value' => 1000],
                'trans' => [
                    ['value' => 100, 'balance' => 110000],
                    ['value' => 100, 'balance' => 120000],
                ],
            ],
            [
                'fund' => ['shares' => 100000, 'value' => 1000],
                'trans' => [
                    ['value' => 100, 'balance' => 10000],
                    ['value' => 100, 'balance' => 20000],
                ],
            ],
        ];
        
        // create transactions towards the fund account (not user account)
        // NO matching, source SPO, type DEP
        // increase balance
        // increase CASH position
    }

}
