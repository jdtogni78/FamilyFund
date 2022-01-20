<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Portfolio;
use App\Models\Fund;
use Tests\DataFactory;

class PortfolioExtApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    public function validateAssets($portfolio, $data)
    {
        $asOf = $data->timestamp;
        $mode = $data->mode;
        $value = $portfolio->valueAsOf($asOf);
        foreach ($data->symbols as $symbol => $symbolData) {
            $price = $symbolData->price;
            $this->assertEquals($portfolio->priceOfAssetAsOf($symbol, $asOf), $price);
            if ($mode == 'positions') {
                $position = $symbolData->position;
                // TODO: validate price types (cash has 2 dec, bitcoin has 8 dec, etc)
                $this->assertEquals($portfolio->positionOfAssetAsOf($symbol, $asOf), $position);
            }
        }
        $this->assertEquals($data->symbols->count(), $portfolio->portfolioAssets()->count());
    }

    public function _test_update_assets($data)
    {
        $factory = new DataFactory();
        $factory->createFund();
        $portfolio = $factory->portfolio;
        
        $preValidate = $data->preValidate;
        if ($preValidate) {
            $this->validateAssets($portfolio, $preValidate);
        }

        $this->response = $this->json(
            'POST',
            '/api/portfolios/'.$portfolio->code.'/update_assets/', $data->post
        );

        $this->assertApiResponse($portfolio);
        $this->validateAssets($portfolio, $data->post);
    }
    
    /**
     * @test
     */
    // Bulk Update Samples
    public function test_portfolio_assets_update()
    {
        $data = 
        [
            [
                'preValidate' => [
                    'timestamp' => '2022-01-17T07:16:24',
                    'symbols' => [
                        'CASH'  => ['position' => 1000.0], // cash never changes price
                    ],
                ],
                'post' => [
                    'timestamp' => '2022-01-17T07:16:24',
                    'mode' => 'positions',
                    'symbols' => [
                        'CASH'  => ['position' => 0.0], // cash never changes price
                        'SPXL2' => ['price' =>   111.11, 'position' => 10.00000000],
                        'ETH3'  => ['price' => 50000.01, 'position' =>  0.123456789], // may round up
                        'BTC2'  => ['price' => 50000.01, 'position' =>  0.12345679],
                    ],
                ],
            ],
            [
                'preValidate' => [ // can be run in sequence
                    'timestamp' => '2022-01-17T07:35:32',
                    'symbols' => [
                        'CASH'  => ['position' => 0.0], // cash never changes price
                        'SPXL2' => ['price' =>   111.11, 'position' => 10.00000000],
                        'ETH3'  => ['price' => 50000.01, 'position' =>  0.123456789], // may round up
                        'BTC2'  => ['price' => 50000.01, 'position' =>  0.12345679],
                    ],
                ],
                'post' => [
                    'timestamp' => '2022-01-17T07:35:32',
                    'mode' => 'positions',
                    'symbols' => [
                        'CASH'   => ['position' => 222.22], // cash never changes price
                        'SPXL2'  => ['price' =>   111.11, 'position' => 10.00000000 ],
                        'ETH3'   => ['price' =>     0.00, 'position' => 12345678.12340000 ], // that is concerning, should cause share calculation failures
                        'FIPDX2' => ['price' => '133.01', 'position' => 12345678.12340000 ],
                        'LTC2'   => ['price' => '600000.01' ], // treat as position=0
                    ],
                ],
            ],
            [
                'post' => [
                    'timestamp' => '2022-01-19T07:35:32',
                    'mode' => 'price_only',
                    'symbols' => [
                        'SPXL2'  => ['price' =>   111.12],
                        'ETH3'   => ['price' =>     0.00], // that is concerning, should cause share calculation failures
                        'FIPDX2' => ['price' => '133.02'],
                        'LTC2'   => ['price' => '600000.02'], // treat as position=0
                    ],
                ],
            ],
        ];

        foreach ($data as $d) {
            $this->_test_update_assets($d);
        }
    }
}
