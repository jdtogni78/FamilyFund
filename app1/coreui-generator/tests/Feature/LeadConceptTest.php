<?php
namespace Tests\Feature;

use DateTime;

class LeadConceptTest extends PortfolioAssetsUpdateBaseTest
{
    public function test_portfolio_assets_update()
    {
        $this->cashId = 158;
        $this->date = new DateTime("2022-01-09");
        $max_id = $this->getMaxId('assets');
        $symbol = "Symbol_" . $max_id;

        $this->reviewAndResetPortfolio();
        $this->deleteCreatedEntities('asset_prices');
//TODO        $this->assertEquals(0, $count); // lets start fresh

        $this->_testSampleCall($max_id, $symbol);

        print_r("\n** TEST Next 3 tests are about historical record creation in mode=positions ***\n\n");
        $this->_testNoPricePositionChange($max_id, $symbol);

        $oldTimestamp = $this->post['timestamp'];
        $oldPrice = $this->post['symbols'][$symbol]['price'];
        $oldPosition = $this->post['symbols'][$symbol]['position'];

        $this->_test2DaysAhead($max_id, $symbol);
        $this->_test1DayBack($max_id, $symbol, $oldTimestamp, $oldPrice, $oldPosition);
    }

    /**
     * @return void
     */
    public function _test1DayBack($max_id, $symbol, $ts1, $price1, $position1): void
    {
        $ts2 = $this->post['timestamp'];
        $price2 = $this->post['symbols'][$symbol]['price'];
        $position2 = $this->post['symbols'][$symbol]['position'];

        print_r("\n** TEST3 * subtract 1 day from timestamp\n\n");
        $this->prevDay();
        print_r("\n** TEST3 * change price of symbol\n\n");
        $this->post['symbols'][$symbol]['price'] = 55.55;
        $this->postAssetUpdates();

        print_r("\nVALIDATE: new price is created with timestamp & enddate as next day\n");
        print_r("\nVALIDATE: old price has end date with timestamp & no change to its start date\n");
        print_r("\nVALIDATE: next day has price with start date with next day\n");
        $this->_get("assets/" . $max_id, true);
        $aps = $this->data['asset_prices'];
        $this->validate3Historical($aps, $symbol, $ts1, $price1, $ts2, $price2, 'asset_prices', 'price');

        $pas = $this->getPortfolioAssets($max_id);
        $this->validate3Historical($pas, $symbol, $ts1, $position1, $ts2, $position2, 'portfolio_assets', 'position');

        print_r("\nVALIDATE: no new position is created for cash\n");
        $this->validateNoChangeCash();
    }

    /**
     * @param string $symbol
     * @param $max_id
     * @return void
     */
    public function _test2DaysAhead($max_id, string $symbol): void
    {
        $oldTimestamp = $this->post['timestamp'];
        $oldPrice = $this->post['symbols'][$symbol]['price'];
        $oldPosition = $this->post['symbols'][$symbol]['position'];

        print_r("\n** TEST2 * add 2 days to timestamp\n");
        $this->nextDay(1);
        $this->nextDay(1);

        print_r("** TEST2 * change price of symbol\n");
        $this->post['symbols'][$symbol]['price'] = 123.45;
        $this->postAssetUpdates();

        $this->_get("assets/" . $max_id, true);
        $aps = $this->data['asset_prices'];
        print_r("\nVALIDATE: new price is created with timestamp\n");
        print_r("\nVALIDATE: old price has end date with timestamp\n");
        $this->validate2Historical($aps, $symbol, $oldTimestamp, $oldPrice, 'asset_prices', 'price');

        print_r("\nVALIDATE: new position is created with timestamp\n");
        print_r("\nVALIDATE: old position has end date with timestamp\n");
        $pas = $this->getPortfolioAssets($max_id);
        $this->validate2Historical($pas, $symbol, $oldTimestamp, $oldPosition, 'portfolio_assets', 'position');

        $this->validateNoChangeCash();
    }

    /**
     * @param $max_id
     * @param $symbol
     * @return void
     */
    public function _testNoPricePositionChange($max_id, $symbol): void
    {
        print_r("\n** TEST1 * add one day to timestamp (from sample call)\n\n");
        $this->nextDay(1);
        $this->postAssetUpdates();

        print_r("\nVALIDATE: no new price or position records are created for either symbol or cash\n");
        $this->_get("assets/" . $max_id, true);
        $aps = $this->data['asset_prices'];
        $this->validateUniqueHistorical($aps, $symbol, 'asset_prices', 'price');

        $pas = $this->getPortfolioAssets($max_id);
        $this->validateUniqueHistorical($pas, $symbol, 'portfolio_assets', 'position');

        $this->validateNoChangeCash();
    }


    /**
     * @param mixed $max_id
     * @param $symbol
     * @return void
     */
    public function _testSampleCall(mixed $max_id, $symbol): void
    {
        print_r("\n** TEST sample positions call: send (mode positions) for a timestamp in the past\n\n");
        print_r("\n** TEST * non-existent asset with position & price\n\n");
        print_r("\n** TEST * cash position\n\n");
        $this->_get("assets/" . $max_id, true);
        $this->assertApiError();

        $this->post = $this->getSampleRequest($symbol);
        $this->postAssetUpdates();

        // data should be empty:
        $this->assertCount(0, $this->data);

        $this->_get("assets/" . $max_id, true);
        $this->assertApiSuccess();

        print_r("\nVALIDATE: asset is created with feed id, source, name and type\n");
        $this->assertEquals($symbol, $this->data['name']);
        $this->assertEquals($symbol, $this->data['feed_id']);
        $this->assertEquals($this->code, $this->data['source_feed']);
        $this->assertEquals("DC", $this->data['type']);

        print_r("\nVALIDATE: new asset price is created with start date = timestamp and correct price, correct type\n");
        $aps = $this->data['asset_prices'];
        $this->validateUniqueHistorical($aps, $symbol, 'asset_prices', 'price');
        $this->toDelete['assets'][] = $max_id;

        print_r("\nVALIDATE: new portfolio_assets is created with start date = timestamp and correct position\n");
        $pas = $this->getPortfolioAssets($max_id);
        $this->validateUniqueHistorical($pas, $symbol, 'portfolio_assets', 'position');

        print_r("\nVALIDATE: new portfolio assets is created with start date = timestamp and correct position (using cash.id 10)\n");
        $this->validateNoChangeCash();
    }

}



