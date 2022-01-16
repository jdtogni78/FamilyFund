<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Transaction;
use App\Models\Utils;

class TransactionApiGoldenDataTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_read_transaction()
    {
        $verbose = false;
        $transactions = Transaction::all();

        $accts = array();
        foreach($transactions as $transaction) {
            if (!array_key_exists($transaction->account_id, $accts))
                $accts[$transaction->account_id] = 0;
            $accts[$transaction->account_id] += $transaction->shares;


            $account = $transaction->account()->first();
            $fund = $account->fund()->first();
            $asOf = substr($transaction->created_at,0,10);
            $shareValue = $fund->shareValueAsOf($asOf);
            $totalShares = $fund->sharesAsOf($asOf);

            if ($verbose) {
                print_r([$transaction->account()->count()]);
                print_r([$account->fund()->count()]);
                $arr = array();
                $arr['id'] = $transaction->id;
                $arr['type'] = $transaction->type;
                $arr['value'] = $transaction->value;
                $arr['shares'] = $transaction->shares;
                $arr['shareValue'] = $shareValue;
                $arr['totalShares'] = $totalShares;
                $arr['account_id'] = $account->id;
                $arr['fund_id'] = $fund->id;
                $arr['asOf'] = $asOf;
                print_r($arr);
            }
            
            $portfolio = $fund->portfolio();
            $assets = $portfolio->valueAsOf($asOf, $verbose);
            $this->assertEquals(Utils::shares($transaction->value / $shareValue), $transaction->shares);
            $this->assertEquals($transaction->value, Utils::currency($shareValue * $transaction->shares));
            // AccountBalance::
            // find the balance change
            // calculate 
        }
    }

}
