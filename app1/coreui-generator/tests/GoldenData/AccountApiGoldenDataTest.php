<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Account;

class AccountApiGoldenDataTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    public function create_own_balance($shares, $value)
    {
        $balance = array();
        $balance['type'] = 'OWN';
        $balance['shares'] = $shares;
        $balance['market_value'] = $value;
        return $balance;
    }

    public function create_transaction($account, $tran_id, $shares, $value, $currentValue, $matching, $date)
    {
        $transaction = array();
        $transaction['id'] = $tran_id;
        $transaction['shares'] = $shares;
        $transaction['value'] = $value;
        if ($matching != null)
            $transaction['matching_id'] = $matching;
        $transaction['created_at'] = $date;
        // $transaction['account_id'] = $account;
        $transaction['type'] = 'PUR';
        $transaction['current_value'] = $currentValue;
        
        return $transaction;
    }

    public function _test_account_balance_as_of($id, $asOf, $shares, $balance)
    {
        $account = Account::find(7);

        $this->response = $this->json(
            'GET',
            '/api/accounts/'.$account->id.'/as_of/'.$asOf
        );

        $arr = $account->toArray();
        $arr['balances'][] = $this->create_own_balance($shares, $balance);
        $this->assertApiResponse($arr);
    }

    public function _test_account_transactions_as_of($id, $asOf, $transactions, $currentValues)
    {
        $account = Account::find(7);

        $this->response = $this->json(
            'GET',
            '/api/accounts/'.$account->id.'/transactions_as_of/'.$asOf
        );

        $arr = array();
        $arr['nickname'] = $account->nickname;
        $arr['id'] = $id;
        $i = 0;
        foreach ($transactions as $transaction) {
            [$tran_id, $shares, $value, $matching, $date] = $transaction;
            $currentValue = $currentValues[$i++];
            $arr['transactions'][] = $this->create_transaction($id, $tran_id, $shares, $value, $currentValue, $matching, $date);
        }
        // var_dump($arr);
        // print($this->response->getContent());
        $this->assertApiResponse($arr);
    }

    public function account7_balances()
    {
        return [2000, 2519.49, 3487.84, 3462.53];
    }
    
    public function compareFloats($a, $b)
    {
        return abs($a - $b) < 0.0001;
    }

    /**
     * @test
     */
    public function test_account_balance_as_of()
    {
        $balance = $this->account7_balances();
        $this->_test_account_balance_as_of(7, '2021-01-01', 2000, $balance[0]);
        $this->_test_account_balance_as_of(7, '2021-07-01', 2270.3298, $balance[1]);
        $this->_test_account_balance_as_of(7, '2022-01-01', 2270.3298, $balance[2]);
        $this->_test_account_balance_as_of(7, '2022-01-15', 2566.857, $balance[3]);
    }

    /**
     * @test
     */
    public function test_account_transactions_as_of()
    {
        $time = 'T00:00:00.000000Z';
        $t1 = [46,     2000, 2000, null, '2021-01-01' . $time];
        $t2 = [42, 135.1649,  150, null, '2021-07-01' . $time];
        $t3 = [44, 135.1649,  150,    1, '2021-07-01' . $time];
        $time = 'T02:35:00.000000Z';
        $t5 = [22, 111.1977,  150, null, '2022-01-09' . $time];
        $t7 = [23, 111.1977,  150,    4, '2022-01-09' . $time];
        $t4 = [20,  37.0659,   50, null, '2022-01-09' . $time];
        $t6 = [21,  37.0659,   50,    1, '2022-01-09' . $time];

        $balances = $this->account7_balances();
        $this->_test_account_transactions_as_of(7, '2021-01-01', [$t1], [$balances[0]]);
        $this->_test_account_transactions_as_of(7, '2021-07-01', [$t1, $t2, $t3], 
            $values = [2219.49, 150, 150]);
        $this->compareFloats(array_sum($values), $balances[1]); 

        $this->_test_account_transactions_as_of(7, '2022-01-01', [$t1, $t2, $t3], 
            $values = [3072.54, 207.65, 207.65]);
        $this->compareFloats(array_sum($values), $balances[2]); 
        $this->_test_account_transactions_as_of(7, '2022-01-15', [$t1, $t2, $t3, $t4, $t5, $t6, $t7], 
            $values = [2697.87, 182.33, 182.33, 50, 150, 50, 150]);
        $this->compareFloats(array_sum($values), $balances[3]); 
    }

    // TODO test account performance
}
