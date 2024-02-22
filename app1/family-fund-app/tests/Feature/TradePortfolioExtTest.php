<?php

namespace Tests\Feature;

use App\Models\PortfolioExt;
use App\Models\PositionUpdate;
use App\Models\SymbolPosition;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Log;
use Tests\DataFactory;
use Tests\TestCase;
use Tests\ApiTestTrait;
use const null;

class TradePortfolioExtTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    private DataFactory $factory;
    private $inf;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->inf = Carbon::parse('9999-12-31');
        $this->factory = $factory = new DataFactory();
        $factory->createTradePortfolio(Carbon::today());
        Log::debug('TradePortfolioExtTest::setUp');
    }

    /**
     * @dataProvider providerSplitDates
     */
    public function testSplitDates($start1, $end1, $start2, $end2, $errRegEx) {
        Log::debug("testSplitDates: $start1, $end1, $start2, $end2, $errRegEx");
        $tp = $this->factory->tradePortfolio;
        $tp->start_dt = $start1;
        $tp->end_dt = $end1;
        $tp->save();

        $this->assertTrue($tp->start_dt->eq($start1));
        $this->assertTrue($tp->end_dt->eq($end1));

        $msg = null;
        try {
            $newTP = $this->_testSlitBase($start2, $end2);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            Log::debug("Caught exception: " . $msg);
            $this->assertNotNull($errRegEx, "Should not fail, found: " . $msg);
        }
        // assert when $msg matches regex $error
        if ($msg === null) {
            $this->assertNull($errRegEx, "Should fail, but did not, expected: $errRegEx");
        } else {
            $this->assertMatchesRegularExpression("/$errRegEx/", $msg);
        }
    }

    public function providerSplitDates() {
        $today = Carbon::today()->format('Y-m-d');
        $yesterday = Carbon::today()->subDay()->format('Y-m-d');
        $tomorrow = Carbon::today()->addDay()->format('Y-m-d');
        $d3 = Carbon::today()->addDays(3)->format('Y-m-d');
        $d4 = Carbon::today()->addDays(4)->format('Y-m-d');
        $inf = Carbon::parse('9999-12-31')->format('Y-m-d');

        return array(
            array($today,     $inf,      $tomorrow, $inf, null), // one day later: split tomorrow
            array($yesterday, $inf,      $today,    $inf, null), // one day later: split today
            array($yesterday, $today,    $today,    $inf, null), // split at exact end, making it infinite
            array($tomorrow,  $d4,       $d3,       $inf, null), // split making it infinite
            array($today,     $tomorrow, $d4,       $inf,      "Start date .* cannot be greater than previous end date"),
            array($tomorrow,  $d4,       $tomorrow, $inf,      "Start date .* must be greater than previous start date"),
            array($today,     $inf,      $tomorrow, $today,    "End date .* must be greater than today"),
            array($today,     $inf,      $d4,       $tomorrow, "End date .* must be greater than start date"),
            array($today,     $inf,      $tomorrow, $d4,       "End date .* must be greater than previous end date"),
        );
    }

    private function _testSlitBase($start_dt, $end_dt)
    {
        $factory = $this->factory;
        $tradePortfolio = $factory->tradePortfolio;
        $orig_start_dt = $tradePortfolio->start_dt;
        Log::debug('tradePortfolio: ' . json_encode($tradePortfolio->toArray()));

        $newTP = $tradePortfolio->splitWithItems($start_dt, $end_dt);
        Log::debug('tradePortfolio: ' . json_encode($tradePortfolio->toArray()));

        $tp_start_dt = $tradePortfolio->start_dt;
        $tp_end_dt = $tradePortfolio->end_dt;
        $this->assertTrue($tp_start_dt->eq($orig_start_dt), "TP Start dt: $tp_start_dt == (orig start) $orig_start_dt"); // no change
        $this->assertTrue($tp_end_dt->eq($start_dt), "TP End dt: $tp_end_dt == (start dt) $start_dt"); // updated to new start date
        $this->assertTrue($newTP->start_dt->eq($start_dt), "New TP Start dt: " . $newTP->start_dt . " == (start dt) $start_dt");
        $this->assertTrue($newTP->end_dt->eq($end_dt), "New TP End dt: " . $newTP->end_dt . " == (end dt) $end_dt");

        return $newTP;
    }

    public function testSplit() {
        Log::debug('testSplit');
        $factory = $this->factory;
        $tradePortfolio = $factory->tradePortfolio;
        $newTP = $this->_testSlitBase(Carbon::tomorrow(), $this->inf);

        // check columns: account_name, portfolio_id, cash_target, cash_reserve_target, max_single_order, minimum_order, rebalance_period
        $this->assertEquals($tradePortfolio->account_name, $newTP->account_name, "Account name: " . $tradePortfolio->account_name . " == " . $newTP->account_name);
        $this->assertEquals($tradePortfolio->portfolio_id, $newTP->portfolio_id, "Portfolio id: " . $tradePortfolio->portfolio_id . " == " . $newTP->portfolio_id);
        $this->assertEquals($tradePortfolio->cash_target, $newTP->cash_target, "Cash target: " . $tradePortfolio->cash_target . " == " . $newTP->cash_target);
        $this->assertEquals($tradePortfolio->cash_reserve_target, $newTP->cash_reserve_target, "Cash reserve target: " . $tradePortfolio->cash_reserve_target . " == " . $newTP->cash_reserve_target);
        $this->assertEquals($tradePortfolio->max_single_order, $newTP->max_single_order, "Max single order: " . $tradePortfolio->max_single_order . " == " . $newTP->max_single_order);
        $this->assertEquals($tradePortfolio->minimum_order, $newTP->minimum_order, "Minimum order: " . $tradePortfolio->minimum_order . " == " . $newTP->minimum_order);
        $this->assertEquals($tradePortfolio->rebalance_period, $newTP->rebalance_period, "Rebalance period: " . $tradePortfolio->rebalance_period . " == " . $newTP->rebalance_period);

        // check items
        foreach ($tradePortfolio->tradePortfolioItems()->get() as $item) {
            Log::debug('item: ' . json_encode($item->toArray()));
            $this->assertTrue($item->trade_portfolio_id == $tradePortfolio->id);

            // trade_portfolio_id, symbol, type, target_share, deviation_trigger
            $newItem = $newTP->tradePortfolioItems()->get()->where('symbol', $item->symbol)->first();
            $this->assertNotNull($newItem, "New item is not null");
            $this->assertTrue($item->target_share == $newItem->target_share,
                "Target share: " . $item->target_share . " == " . $newItem->target_share);
            $this->assertTrue($item->deviation_trigger == $newItem->deviation_trigger,
                "Deviation trigger: " . $item->deviation_trigger . " == " . $newItem->deviation_trigger);
            $this->assertEquals($item->type, $newItem->type,
                "Type: " . $item->type . " == " . $newItem->type);
            $this->assertEquals($item->symbol, $newItem->symbol,
                "Symbol: " . $item->symbol . " == " . $newItem->symbol);
            $this->assertEquals($newTP->id, $newItem->trade_portfolio_id,
                "Trade portfolio id: " . $newTP->id . " == " . $newItem->trade_portfolio_id);
        }
    }


}
