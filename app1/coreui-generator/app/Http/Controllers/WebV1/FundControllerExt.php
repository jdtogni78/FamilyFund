<?php

namespace App\Http\Controllers\WebV1;

use App\Charts\BarChart;
use App\Charts\DoughnutChart;
use App\Charts\LineChart;
use App\Repositories\FundRepository;
use Flash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Response;
use App\Http\Controllers\FundController;
use App\Http\Controllers\APIv1\FundAPIControllerExt;
use App\Http\Controllers\APIv1\PortfolioAPIControllerExt;
use App\Models\PerformanceTrait;
use App\Repositories\PortfolioRepository;
use Spatie\TemporaryDirectory\Exceptions\PathAlreadyExists;
use Spatie\TemporaryDirectory\TemporaryDirectory;

class FundControllerExt extends FundController
{
    use PerformanceTrait;

    public function __construct(FundRepository $fundRepo)
    {
        parent::__construct($fundRepo);
    }

    /**
     * Display the specified Fund.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return $this->showAsOf($id, null);
    }

    /**
     * Display the specified Fund.
     *
     * @param int $id
     *
     * @return Response
     */
    public function showAsOf($id, $asOf=null)
    {
        $fund = $this->fundRepository->find($id);

        if (empty($fund)) {
            Flash::error('Fund not found');
            return redirect(route('funds.index'));
        }

        $arr = $this->createViewData($fund, $asOf);

        return view('funds.show_ext')
            ->with('api', $arr);
    }

    /**
     * Display the specified Fund.
     * @param int $id
     * @return Response
     * @throws PathAlreadyExists
     */
    public function showPDFAsOf($id, $asOf=null)
    {
        $fund = $this->fundRepository->find($id);

        if (empty($fund)) {
            Flash::error('Fund not found');
            return redirect(route('funds.index'));
        }

        $arr = $this->createViewData($fund, $asOf);

        $pdf = App::make('snappy.pdf.wrapper')
//            ->setOption("javascript-delay", 2000)
            ->setOption("enable-local-file-access", true)
            ->setOption("print-media-type", true)
//            ->setOption("viewport-size", "1024x768")
//            ->setOption("allow", "/tmp")
        ;
        $files = [];
        $tempDir = (new TemporaryDirectory())->force();

        try {
            $tempDir->create();
//            $tempDir->delete();
        } catch (Exception $e) {
            print_r($e);
        }
        $this->createAllocatedSharesGraph($arr, $tempDir, $files);
        $this->createAccountsAllocationGraph($arr, $tempDir, $files);
        $this->createAssetsAllocationGraph($arr, $tempDir, $files);
        $this->createYearlyPerformanceGraph($arr, $tempDir, $files);
        $this->createMonthlyPerformanceGraph($arr, $tempDir, $files);
        $html = view('funds.show_pdf')
            ->with('api', $arr)
            ->with('files', $files)
            ->render()
        ;
        $myfile = fopen($tempDir->path('fund.html'), "w") or die("Unable to open file!");
        fwrite($myfile, $html);

        $pdf->loadView('funds.show_pdf', [
            'api' => $arr,
            'files' => $files
        ]);
        $pdf->save($tempDir->path('fund.pdf'));

        return $pdf->inline('fund.pdf');
    }

    protected function createViewData($fund, $asOf) {
        set_time_limit(0);
        if ($asOf == null) $asOf = date('Y-m-d');

        $arr = array();
        $api = new FundAPIControllerExt($this->fundRepository);
        $arr = $api->createFundResponse($fund, $asOf);
        $arr['monthly_performance'] = $api->createMonthlyPerformanceResponse($asOf);
        $arr['yearly_performance'] = $api->createYearlyPerformanceResponse($asOf);
        $arr['balances'] = $api->createAccountBalancesResponse($fund, $asOf);

        $portController = new PortfolioAPIControllerExt(\App::make(PortfolioRepository::class));
        $portfolio = $fund->portfolios()->first();
        $arr['portfolio'] = $portController->createPortfolioResponse($portfolio, $asOf);

        $arr['as_of'] = $asOf;
        return $arr;
    }

    /**
     * @param array $api
     * @param TemporaryDirectory $tempDir
     * @param array $files
     * @return void
     */
    protected function createAllocatedSharesGraph(array $api, TemporaryDirectory $tempDir, array &$files): void
    {
        $name = 'allocated_shares.png';
        $values = [$api['summary']['allocated_shares_percent'], $api['summary']['unallocated_shares_percent']];
        $labels = ['Allocated', 'Unallocated'];

        $files[$name] = $file = $tempDir->path($name);
        $this->createDoughnutChart($values, $labels, $file);
    }

    private function createAccountsAllocationGraph(array $api, TemporaryDirectory $tempDir, array &$files)
    {
        $name = 'accounts_allocation.png';
        $arr = $api['balances'];
        $labels = array_map(function ($v) {return $v['nickname'];}, $arr);
        $values = array_map(function ($v) {return $v['shares'];}, $arr);

        $labels[] = 'Unallocated';
        $values[] = $api['summary']['unallocated_shares'];

        $files[$name] = $file = $tempDir->path($name);
        $this->createDoughnutChart($values, $labels, $file);
    }

    private function createAssetsAllocationGraph(array $api, TemporaryDirectory $tempDir, array &$files)
    {
        $name = 'assets_allocation.png';
        $arr = $api['portfolio']['assets'];
        $labels = array_map(function ($v) {return $v['name'];}, $arr);
        $values = array_map(function ($v) {return $v['value'];}, $arr);

        $files[$name] = $file = $tempDir->path($name);
        $this->createDoughnutChart($values, $labels, $file);
    }


    private function createYearlyPerformanceGraph(array $api, TemporaryDirectory $tempDir, array &$files)
    {
        $name = 'yearly_performance.png';
        $arr = $api['yearly_performance'];
        $labels = array_keys($arr);
        $values = array_map(function ($v) {return $v['value'];}, $arr);

        $files[$name] = $file = $tempDir->path($name);
        $this->createBarChart($values, $labels, $file);
    }

    private function createMonthlyPerformanceGraph(array $api, TemporaryDirectory $tempDir, array &$files)
    {
        $name = 'monthly_performance.png';
        $arr = $api['monthly_performance'];
        $labels = array_keys($arr);
        $values = array_map(function ($v) {return $v['value'];}, $arr);

        $files[$name] = $file = $tempDir->path($name);
        $this->createLineChart($values, $labels, $file);
    }

    /**
     * @param array $values
     * @param array $labels
     * @param string $file
     * @return void
     */
    protected function createDoughnutChart(array $values, array $labels, string $file): void
    {
        $chart = new DoughnutChart();
        $chart->values = $values;
        $chart->labels = $labels;
        $chart->createChart();
        $chart->saveAs($file);
    }

    private function createLineChart(array $values, array $labels, string $file)
    {
        $chart = new LineChart();
        $chart->values = $values;
        $chart->labels = $labels;
        $chart->titleValues = "Performance";
        $chart->titleLabels = "Date";
        $chart->createChart();
        $chart->saveAs($file);
    }

    private function createBarChart(array $values, array $labels, string $file)
    {
        $chart = new BarChart();
        $chart->values = $values;
        $chart->labels = $labels;
        $chart->titleValues = "Performance";
        $chart->titleLabels = "Date";
        $chart->createChart();
        $chart->saveAs($file);
    }


}
