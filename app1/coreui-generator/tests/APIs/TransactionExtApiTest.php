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
use DB;

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

        $this->assertEquals($tran->referredTransactionMatching()->count(), $hasMatching?1:0);

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
            $this->_test_create_transaction($d);
            DB::rollBack();
        }
    }

    public function _test_create_transaction($data)
    {
        $factory = new DataFactory();

        $fund = $factory->createFund($data['fund']['shares'], $data['fund']['value']);
        $user = $factory->createUser();
        if ($data['match']) {
            $matching = $factory->createMatching($data['match']['limit'], $data['match']['match']);
            $factory->createAccountMatching();
        }
        print_r($fund->toArray());
        print_r($user->toArray());
        print_r($factory->userAccount->toArray());
        print_r($matching->toArray());
        print_r($matching->accountMatchingRules()->first()->toArray());

        foreach($data['trans'] as $dtran) {
            $transaction = $factory->makeTransaction($dtran['value']);
            $this->postTransaction($transaction);

            $response = json_decode($this->response->getContent(), true);
            $rdata = $response['data'];
            $tran = Transaction::find($rdata['id']);
            $this->assertNotNull($tran);

            print_r("\n");
            print_r($tran->toArray());
            $this->validateTransaction($tran, $transaction, $dtran['value'], $dtran['balance']);

            if ($data['match']) {
                $matchTran = $tran->transaction_matchings()->first();
                print_r($matchTran->toArray());
                $this->validateTransaction($matchTran, $transaction, $dtran['match']['value'], $dtran['match']['balance']);
            }
        }
    }

    public function _test_create_fund_transaction($data) {
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
