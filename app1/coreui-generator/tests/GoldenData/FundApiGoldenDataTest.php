<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Account;
use App\Models\Fund;
use App\Models\Portfolio;
use App\Models\AccountExt;
use App\Models\PortfolioExt;
use App\Models\Utils;

class FundApiGoldenDataTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    private function _test_fund_as_of($id, $asOf, $value, $shares, $unallocated)
    {
        $fund = Fund::find($id);

        $this->response = $this->json(
            'GET',
            '/api/funds/'.$fund->id.'/as_of/'.$asOf
        );

        // print($this->response->getContent());

        $calc = array();
        $calc['value'] = $value;
        $calc['shares'] = $shares;
        $calc['share_value'] = Utils::currency($value/$shares);
        $calc['unallocated_shares'] = $unallocated;
        $calc['as_of'] = $asOf;
        $arr = $fund->toArray();
        $arr['calculated'] = $calc;
        $this->assertApiResponse($arr);
    }
    
    public static function fund2_values()
    {
        return [25000, 28343.62, 39237.36, 34452.72];
    }

    public static function fund2_shares()
    {
        return [25000, 25540.6597];
    }
    
    /**
     * @test
     */
    public function test_fund_as_of()
    {
        $shares = $this->fund2_shares();
        $values = $this->fund2_values();
        $this->_test_fund_as_of(2, '2021-01-01', $values[0], $shares[0], 10000);
        $this->_test_fund_as_of(2, '2021-07-02', $values[1], $shares[1], 10000.0001);
        $this->_test_fund_as_of(2, '2022-01-01', $values[2], $shares[1], 10000.0001);
        $this->_test_fund_as_of(2, '2022-01-15', $values[3], $shares[1], 7108.8599);
    }


    private function _test_fund_performance_as_of($id, $asOf, $performances)
    {
        $fund = Fund::find($id);

        $this->response = $this->json(
            'GET',
            '/api/funds/'.$fund->id.'/performance_as_of/'.$asOf
        );

        // print($this->response->getContent());

        $arr = array();
        $arr['id'] = $id;
        $arr['name'] = $fund->name;
        $arr['as_of'] = $asOf;

        $perf = array();
        foreach ($performances as $performance) {
            [$year, $yp, $sv, $s, $v] = $performance;
            $p = array();
            $p['performance']   = Utils::percent($yp);
            $p['shareValue']    = Utils::currency($sv);
            $p['shares']        = Utils::shares($s);
            $p['value']         = Utils::currency($v);
            $perf[$year] = $p;
        }

        $arr['performance'] = $perf;
        $this->assertApiResponse($arr);
    }

    /**
     * @test
     */
    public function test_fund_performance_as_of()
    {
        $shares = $this->fund2_shares();
        $values = $this->fund2_values();

        $p21     = ["2021",         0.0, 1.00, $shares[0], $values[0]];
        $p2107   = ["2021-07-01",  0.13, 1.11, $shares[1], $values[1]];
        $p22     = ["2022",         0.0, 1.54, $shares[1], $values[2]];
        $p220115 = ["2022-01-15", -0.12, 1.35, $shares[1], $values[3]];

        $this->_test_fund_performance_as_of(2, '2021-01-01', [$p21]);
        $this->_test_fund_performance_as_of(2, '2021-07-01', [$p21, $p2107]);
        $this->_test_fund_performance_as_of(2, '2022-01-01', [$p21, $p22]);
        $this->_test_fund_performance_as_of(2, '2022-01-15', [$p21, $p22, $p220115]);
    }


    private function _test_fund_balances_as_of($id, $asOf, $balances)
    {
        $fund = Fund::find($id);

        $this->response = $this->json(
            'GET',
            '/api/funds/'.$fund->id.'/account_balances_as_of/'.$asOf
        );

        // print($this->response->getContent());

        $arr = array();
        $arr['id'] = $id;
        $arr['name'] = $fund->name;
        $arr['as_of'] = $asOf;

        $bals = array();
        foreach ($balances as $balance) {
            [$user_id, $nickname, $shares] = $balance;
            $b = array();
            $b['nickname'] = $nickname;
            $b['shares'] = $shares;
            $b['user_id'] = $user_id;
            $b['type'] = 'OWN';
            $bals[] = $b;
        }

        $arr['balances'] = $bals;
        $this->assertApiResponse($arr);
    }

    /**
     * @test
     */
    public function test_fund_balances_as_of()
    {
        $b21     = [
            [1, "LT", 2000],
            [2, "GT", 2000],
            [3, "GG", 2000],
            [4, "PG", 2000],
            [5, "NB", 5000],
            [8, "VT", 2000],
            [null, "F2", 25000],
        ];
        $b2107     = [
            [1, "LT", 2270.3298],
            [2, "GT", 2270.3298],
            [3, "GG", 2000],
            [4, "PG", 2000],
            [5, "NB", 5000],
            [8, "VT", 2000],
            [null, "F2", 25540.6597],
        ];
        $b2201     = [
            [1, "LT", 2566.857],
            [2, "GT", 2566.857],
            [3, "GG", 2444.7908],
            [4, "PG", 2296.5272],
            [5, "NB", 5000],
            [8, "VT", 3556.7678],
            [null, "F2", 25540.6597],
        ];

        $this->_test_fund_balances_as_of(2, '2021-01-01', $b21);
        $this->_test_fund_balances_as_of(2, '2021-07-01', $b2107);
        $this->_test_fund_balances_as_of(2, '2022-01-01', $b2107);
        $this->_test_fund_balances_as_of(2, '2022-01-15', $b2201);
    }}
