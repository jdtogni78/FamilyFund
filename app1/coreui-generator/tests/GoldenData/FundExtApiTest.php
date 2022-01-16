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

class FundExtApiTest extends TestCase
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

    /**
     * @test
     */
    public function test_fund_as_of()
    {
        $this->_test_fund_as_of(2, '2021-01-01', 25850.87, 25000, 10000);
        $this->_test_fund_as_of(2, '2021-07-02', 25850.87, 25529.22, 10000);
        $this->_test_fund_as_of(2, '2022-01-01', 35781.53, 25529.22, 10000);
        $this->_test_fund_as_of(2, '2022-01-15', 34452.66, 25529.22, 7110.12760);
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
            $p['performance'] = $yp;
            $p['shareValue'] = $sv;
            $p['shares'] = $s;
            $p['value'] = $v;
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
        $p21     = ["2021",        0.38, 1.03, 25000.00, 25850.87];
        $p2107   = ["2021-07-01",   0.0, 1.01, 25529.22, 25850.87];
        $p22     = ["2022",       -0.04, 1.40, 25529.22, 35781.53];
        $p220115 = ["2022-01-15", -0.04, 1.35, 25529.22, 34452.66];

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
            [1, "LT", 2264.61],
            [2, "GT", 2264.61],
            [3, "GG", 2000],
            [4, "PG", 2000],
            [5, "NB", 5000],
            [8, "VT", 2000],
            [null, "F2", 25529.22],
        ];
        $b2201     = [
            [1, "LT", 2561.0072],
            [2, "GT", 2561.0072],
            [3, "GG", 2444.5957],
            [4, "PG", 2296.3972],
            [5, "NB", 5000],
            [8, "VT", 3556.0851],
            [null, "F2", 25529.22],
        ];

        $this->_test_fund_balances_as_of(2, '2021-01-01', $b21);
        $this->_test_fund_balances_as_of(2, '2021-07-01', $b2107);
        $this->_test_fund_balances_as_of(2, '2022-01-01', $b2107);
        $this->_test_fund_balances_as_of(2, '2022-01-15', $b2201);
    }}
