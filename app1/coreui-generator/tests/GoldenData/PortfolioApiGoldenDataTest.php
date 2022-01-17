<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Portfolio;
use App\Models\Fund;
use App\Models\Utils;

class PortfolioApiGoldenDataTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    public function _test_read_portfolio_as_of($id, $asOf, $assets)
    {
        $portfolio = Portfolio::find($id);

        $this->response = $this->json(
            'GET',
            '/api/portfolios/'.$portfolio->id.'/as_of/'.$asOf
        );

        $as = array();
        $total = 0;
        foreach($assets as $asset) {
            [$asset_id, $name, $price, $shares] = $asset;
            $a = array();
            $a['asset_id'] = $asset_id;
            $a['name'] = $name;
            $a['price']  = Utils::currency($price);
            $a['shares'] = Utils::assetShares($shares);
            $a['value']  = Utils::currency($price * $shares);
            $total += $price * $shares;
            $as[] = $a;
        }
        $arr = $portfolio->toArray();
        $arr['assets'] = $as;
        $arr['total_value'] = Utils::currency($total);
        $this->assertApiResponse($arr);
    }

    /**
     * @test
     */
    public function test_read_portfolio_as_of() {
        $a21 = [
            [1, 'SPXL',     72.25, 67.62800000],
            [2, 'TECL',     40.65, 40.42000000],
            [3, 'SOXL',     31.10, 54.58000000],
            [4, 'IAU',      36.26, 94.00000000],
            [6, 'FIPDX',    11.04, 598.5560000],
            [7, 'ETH',     737.89, 0.40050685],
            [8, 'BTC',   28990.08, 0.01752356],
            [9, 'LTC',     124.42, 1.76610087],
            [11,'XRP',       0.32, 885.16959200],
            [12,'XLM',       0.13, 911.52779760],
            [10,'CASH',      1.00, 5331.8372007],
        ];
        $a22 = [
            [1, 'SPXL',    144.57, 67.628],
            [2, 'TECL',     87.55, 40.42],
            [3, 'SOXL',     68.36, 54.58],
            [4, 'IAU',      34.57, 94],
            [6, 'FIPDX',    11.16, 598.556],
            [7, 'ETH',    3792.43, 0.40050685],
            [8, 'BTC',   48064.96, 0.01752356],
            [9, 'LTC',     147.97, 1.76610087],
            [11,'XRP',       0.81, 885.169592],
            [12,'XLM',       0.27, 911.5277976],
            [10,'CASH',      1.00, 9275.4572008],
        ];
        $this->_test_read_portfolio_as_of(2, '2021-01-01', $a21);
        $this->_test_read_portfolio_as_of(2, '2022-01-01', $a22);
    }
}
