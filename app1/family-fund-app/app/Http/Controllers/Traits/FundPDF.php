<?php

namespace App\Http\Controllers\Traits;

use CpChart\Data;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Spatie\TemporaryDirectory\TemporaryDirectory;

class FundPDF
{
    use BasePDFTrait;

    public function createTradeBandsPDF(array $arr, bool $isAdmin, bool $debugHtml = false)
    {
        $this->constructPDF();
        $tempDir = $this->tempDir;

        $this->createTradeBandsGraph($arr, $tempDir);
        $this->createAssetPositionsGraph($arr, $tempDir);

        $view = 'funds.show_trade_bands_pdf';
        $pdfFile = 'trade_bands.pdf';
        $this->debugHTML($debugHtml, $view, $arr, $tempDir);
        $this->createAndSavePDF($view, $arr, $tempDir, $pdfFile);
    }

    public function createAssetPositionsGraph(array $arr, TemporaryDirectory $tempDir)
    {
        $assetPerf = $arr['asset_monthly_bands'];
        $symbolShares = [];
        foreach ($assetPerf as $symbol => $values) {
            $symbolShares[$symbol] = [];
            foreach ($values as $date => $value) {
                $symbolShares[$symbol][$date] = $value['shares'];
            }

            $name = 'asset_positions_' . $symbol . '.png';
            $this->files[$name] = $file = $tempDir->path($name);
            $labels = array_keys($symbolShares[$symbol]);
            $values = array_values($symbolShares[$symbol]);
            $this->addLineChart($labels,
              ["$symbol Shares"],
              [$values]);
            $this->createLineChart($file);
        }
    }

    /**
     * Create a graph of the trade bands for each symbol
     * @param array $arr
     * @param TemporaryDirectory $tempDir
     */
    public function createTradeBandsGraph(array $arr, TemporaryDirectory $tempDir)
    {
        // create a graph of the trade bands for each symbol$symbol
        $assetPerf = $arr['asset_monthly_bands'];
        $sumData = [];
        foreach ($assetPerf as $symbol => $values) {
            foreach ($values as $date => $value) {
                $sumData[$date] = ($sumData[$date] ?? 0) + $value['value'];
            }
        }
        Log::debug("sumData: " . json_encode($sumData));

        $index = 0;
        foreach ($assetPerf as $symbol => $data) {
            $name = 'trade_bands_' . $symbol . '.png';
            $this->files[$name] = $file = $tempDir->path($name);
            $labels = array_keys($data);
            $values = array_values($data);
            $values = array_map(function ($v) {
                return $v['value'];
            }, $values);

            $values_max = [];
            $values_min = [];
            $values_target = [];
            foreach ($sumData as $date => $value) {
                // find trade portfolio item for this symbol & timeframe
                $port = $this->findTradePortfolioItem($arr, $symbol, $date);
                if ($port == null) {
                  continue;
                }
                $target_share = $port['target_share'];
                $deviation_trigger = $port['deviation_trigger'];
                $up = $target_share + $deviation_trigger;
                $down = $target_share - $deviation_trigger;
                $values_max[] = $sumData[$date] * $up;
                $values_min[] = $sumData[$date] * $down;
                $values_target[] = $sumData[$date] * $target_share;
            }

            Log::debug("values_max: " . json_encode($values_max));
            Log::debug("values_min: " . json_encode($values_min));
            Log::debug("values_target: " . json_encode($values_target));
            Log::debug("values: " . json_encode($values));
            $this->addLineChart($labels,
                ["$symbol", "$symbol target"],
                [$values, $values_target]);
            if (count($values_max) > 0) {
                $this->addZone("$symbol max", "$symbol min", $values_max, $values_min);
            }
            // $this->chart->Palette[$index] = $this->chart->Palette[13];
            $this->createLineChart($file, $index, $symbol);
            $index++;
        }
    }

    public function findTradePortfolioItem(array $arr, string $symbol, string $date)
    {
        foreach ($arr['tradePortfolios'] as $tradePortfolio) {
            if ($tradePortfolio['start_dt'] <= $date && $tradePortfolio['end_dt'] >= $date) {
                foreach ($tradePortfolio['items'] as $item) {
                    if ($item['symbol'] == $symbol) {
                        return $item;
                    }
                }
            }
        }
        return null;
    }

    public function createFundPDF(array $arr, bool $isAdmin, bool $debugHtml = false)
    {
        $this->constructPDF();
        $tempDir = $this->tempDir;

        if ($isAdmin) {
            $this->createSharesAllocationGraph($arr, $tempDir);
            $this->createAccountsAllocationGraph($arr, $tempDir);
        }
        $this->createAssetsAllocationGraph($arr, $tempDir);
        $this->createYearlyPerformanceGraph($arr, $tempDir);
        $this->createMonthlyPerformanceGraph($arr, $tempDir);
        $this->createGroupMonthlyPerformanceGraphs($arr, $tempDir);
        $this->createTradePortfoliosGraph($arr, $tempDir);
        $this->createTradePortfoliosGroupGraph($arr, $tempDir);

        $view = 'funds.show_pdf';
        $pdfFile = 'fund.pdf';
        $this->debugHTML($debugHtml, $view, $arr, $tempDir);
        $this->createAndSavePDF($view, $arr, $tempDir, $pdfFile);
    }

    public function createSharesAllocationGraph(array $api, TemporaryDirectory $tempDir): void
    {
        $name = 'shares_allocation.png';
        $values = [$api['summary']['allocated_shares_percent'], $api['summary']['unallocated_shares_percent']];
        $labels = ['Allocated', 'Unallocated'];

        $this->files[$name] = $file = $tempDir->path($name);
        $this->createDoughnutChart($values, $labels, $file);
    }

    public function createAssetsAllocationGraph(array $api, TemporaryDirectory $tempDir)
    {
        $name = 'assets_allocation.png';
        $arr = $api['portfolio']['assets'];
        $labels = array_map(function ($v) {
            return $v['name'];
        }, $arr);
        $values = array_map(function ($v) {
            return array_key_exists('value', $v) ? $v['value'] : 0;
        }, $arr);

        $this->files[$name] = $file = $tempDir->path($name);
        $this->createDoughnutChart($values, $labels, $file);
    }

    public function createAccountsAllocationGraph(array $api, TemporaryDirectory $tempDir)
    {
        $name = 'accounts_allocation.png';
        $arr = $api['balances'];
        Log::debug($arr);
        $labels = array_map(function ($v) {
            return $v['nickname'];
        }, $arr);
        $values = array_map(function ($v) {
            return $v['shares'];
        }, $arr);

        $labels[] = 'Unallocated';
        $values[] = $api['summary']['unallocated_shares'];

        $this->files[$name] = $file = $tempDir->path($name);
        $this->createDoughnutChart($values, $labels, $file);
    }

    public function createTradePortfoliosGraph(array $api, TemporaryDirectory $tempDir)
    {
        $arr = $api['tradePortfolios'];
        foreach ($arr as $tradePortfolio) {
            $name = 'trade_portfolios_' . $tradePortfolio->id . '.png';

            $labels = array_map(function ($v) {
                return $v['symbol'];
            }, $tradePortfolio->items->toArray());
            $values = array_map(function ($v) {
                return $v['target_share'];
            }, $tradePortfolio->items->toArray());

            $this->files[$name] = $file = $tempDir->path($name);
            $this->createDoughnutChart($values, $labels, $file);
        }
    }

    public function createTradePortfoliosGroupGraph(array $api, TemporaryDirectory $tempDir)
    {
        $arr = $api['tradePortfolios'];
        foreach ($arr as $tradePortfolio) {
            $name = 'trade_portfolios_group' . $tradePortfolio->id . '.png';

            $labels = array_keys($tradePortfolio->groups);
            $values = array_values($tradePortfolio->groups);

            $this->files[$name] = $file = $tempDir->path($name);
            $this->createDoughnutChart($values, $labels, $file);
        }
    }

}
