<?php
namespace Tests\Feature;

use DateTime;

class PortfolioAssetsUpdateBaseTest extends ExternalAPITest
{
    protected $base = 'http://familyfund.leadconcept.business/api/';
    protected $cashId;
    protected $code = 'FFIB';
    protected $fundId;
    protected $portfolioId;

    /**
     * @return void
     */
    protected function reviewAndResetPortfolio(): void
    {
        $this->_get('portfolios/2', true);
        $this->_get('portfolio_assets');
        $count = 0;
        foreach ($this->data as $pa) {
            if ($pa['portfolio_id'] == 2) {
                $count++;
                $this->showPa($pa);
                $this->toDelete['portfolio_assets'][] = $pa['id'];
                if (array_key_exists('asset', $pa) && $pa['asset'] != null) {
                    if ($pa['asset']['name'] != 'CASH') {
                        $this->toDelete['assets'][] = $pa['asset']['id'];
//                    } else {
//                        $this->cash_id = $pa['asset']['id'];
                    }
                }
            }
        }
    }

    public function showPa($pa, $port = 2)
    {
        if ($pa['portfolio_id'] == $port) {
            $this->unsetBase($pa);
            if (array_key_exists('asset', $pa) && $pa['asset'])
                $this->unsetA($pa['asset']);
            $this->p($pa);
        }
    }

    public function unsetA(&$asset){
        unset($asset['name']);
        if (array_key_exists('asset_prices', $asset)) {
            foreach($asset['asset_prices'] as &$ap) {
                $this->unsetAP($ap);
            }
        }
        $this->unsetBase($asset);
    }

    public function unsetAP(&$ap){
        $this->unsetBase($ap);
    }

    public function showA($asset)
    {
        $aps = $asset['asset_prices'];
        $this->unsetA($asset);
        unset($asset['asset_prices']);
        $this->p($asset);
        foreach($aps as $ap) {
            $this->unsetAP($ap);
            $this->p($ap);
        }
    }


    /**
     * @param $table
     * @return int|mixed
     */
    public function getMaxId($table): mixed
    {
        $max_id = 0;
        $this->_get($table);
        foreach ($this->data as $entity) {
            $max_id = max($max_id, $entity['id'] + 1);
        }
        return $max_id;
    }

    public function getSampleRequest(string $symbol, $price=11.11, $pos=22.22): array
    {
        $post = [
            'timestamp' => $this->timestamp(),
            "mode" => "positions",
            "symbols" => [
                $symbol => [
                    "price" => $price,
                    "position" => $pos,
                    "type" => "DC"],
                "CASH" => [
                    #"price" => 1.0,
                    "position" => "10.0"]]
        ];
        return $post;
    }

    /**
     * @param mixed $max_id
     * @param $days
     * @return string
     */
    protected function getSampleRequestAt($days, mixed $max_id=null): string
    {
        if ($max_id == null) $max_id = $this->max_id;
        $symbol = "Symbol_" . $max_id;
        $this->post = $this->getSampleRequest($symbol);
        $this->nextDay($days);
        return $symbol;
    }


    protected function compareTimestamp(mixed $timestamp, mixed $timestamp1)
    {
        return substr($timestamp, 0, 10) == substr($timestamp1, 0, 10);
    }

    protected function isInfinity(mixed $end_dt)
    {
        return $this->compareTimestamp($end_dt, "9999-12-31");
    }

    /**
     * @return mixed
     */
    public function getPortfolioAssets(int $asset_id, $v=false): mixed
    {
        $this->_get('portfolio_assets');
        $pas = [];
        foreach ($this->data as $pa) {
            $this->showPa($pa);
            if (array_key_exists('asset', $pa)
                && $pa['asset'] != null
                && array_key_exists('id', $pa['asset'])
                && $pa['asset']['id'] == $asset_id) {
                if ($v) $this->showPa($pa);
                $pas[] = $pa;
            }
        }
        return $pas;
    }

    public function validateUniqueHistorical($values, string $symbol, $table, $field, $timestamp=null, $eValue=null): void
    {
        if ($timestamp==null) $timestamp = $this->post['timestamp'];
        if ($eValue==null) $eValue = $this->post['symbols'][$symbol][$field];
        $count = count($values);
        $this->assertEquals(1, $count);

        $count = 0;
        foreach ($values as $value) {
            if ($symbol != 'CASH') $this->toDelete[$table][] = $value['id'];
            if ($this->compareTimestamp($value['start_dt'], $timestamp)) {
                $this->assertEquals($value[$field], $eValue);
                $this->assertTrue($this->isInfinity($value['end_dt']));
                $count++;
            }
        }
        $this->assertEquals(1, $count);
    }

    protected function validate2Historical(mixed $values, string $symbol, $ts1, $value1, $table, $field)
    {
        print_r(json_encode([$symbol, $ts1, $value1])."\s");
        $this->assertEquals(2, count($values));
        foreach ($values as $value) {
            print_r(json_encode($value)."\n");
            $this->toDelete[$table][] = $value['id'];
            if ($this->compareTimestamp($value['start_dt'], $this->post['timestamp'])) {
                $this->assertEquals($this->post['symbols'][$symbol][$field], $value[$field]);
                $this->assertTrue($this->isInfinity($value['end_dt']));
            } else {
                $this->assertEquals($this->post['symbols'][$symbol][$field], $value1);
                $this->assertTrue($this->compareTimestamp($value['start_dt'], $ts1));
                $this->assertTrue($this->compareTimestamp($value['end_dt'], $this->post['timestamp']));
            }
        }
    }

    protected function validate3Historical($values, $symbol, $ts1, $value1, $ts2, $value2, string $table, string $field)
    {
        print_r(json_encode([$symbol, $ts1, $value1, $ts2, $value2])."\s");
        $this->assertEquals(3, count($values));
        foreach ($values as $value) {
            $this->toDelete[$table][] = $value['id'];
            if ($this->compareTimestamp($value['start_dt'], $this->post['timestamp'])) { // middle record
                $this->assertTrue($this->compareTimestamp($value['end_dt'], $ts2));
                $this->assertEquals($this->post['symbols'][$symbol][$field], $value[$field]);
            } else if ($this->compareTimestamp($value['start_dt'], $ts1)) {
                $this->assertTrue($this->compareTimestamp($value['end_dt'], $this->post['timestamp']));
                $this->assertEquals($value[$field], $value1);
            } else {
                $this->assertEquals($value[$field], $value2);
                $this->assertTrue($this->compareTimestamp($value['start_dt'], $ts2));
                $this->assertTrue($this->isInfinity($value['end_dt']));
            }
        }
    }



    /**
     * @return void
     */
    public function postAssetUpdates($validate=true): void
    {
        $this->_post('portfolios/'.$this->code.'/assets_update', $this->post);
        if ($validate) $this->assertApiSuccess();
        else $this->assertApiError();
    }

    /**
     * @return void
     */
    public function validateNoChangeCash(): void
    {
        print_r("\nVALIDATE: no new price is created for cash\n");
        $this->_get("assets/" . $this->cashId, true);
        $aps = $this->data['asset_prices'];
        $this->validateUniqueHistorical($aps, 'CASH', 'asset_prices', 'price',
            '2000-01-01', 1.0);

        print_r("\nVALIDATE: no new position is created for cash\n");
        $pas = $this->getPortfolioAssets($this->cashId);
        $this->validateUniqueHistorical($pas, 'CASH', 'portfolio_assets', 'position');
    }

    protected function validateAssetExists(string $symbol, string $source_feed)
    {
        $this->_get("assets");
        foreach ($this->data as $asset) {
            if ($asset['symbol'] == $symbol && $asset['source_id'] == $source_feed) {
                return true;
            }
        }
        $this->fail("Asset with symbol $symbol & code $source_feed not found");
    }

    protected function createFund() {
        $fundId = $this->getMaxId('funds') + 1;
        $this->_post("funds", json_decode('{"name":"Fund_"'.$fundId.',"goal":"Test"}'));
        $this->assertApiSuccess();
        $this->fundId = $fundId;
    }

    protected function createPortfolio($fundId=null) {
        if ($fundId == null) $fundId = $this->fundId;
        $pId = $this->getMaxId('portfolios') + 1;
        $this->_post("portfolios", json_decode('{"fund_id": '.$fundId.',"code":"P'.$pId.'"}'));
        $this->portfolioId = $pId;
        $this->code = "P".$pId;
        $this->assertApiSuccess();
    }


    /**
     * @param string $symbol
     * @param $source_feed
     * @param string $type
     * @return void
     */
    protected function createAsset(string $symbol, $source_feed, string $type="STK"): void
    {
        $this->_post("assets", json_decode(
            '{"name":"' . $symbol . '","type":"'. $type .'","source_feed":"'. $source_feed .'","feed_id":"' . $symbol . '"}'), true);
        $this->assertApiSuccess(); // created mismatched asset
    }

    protected function getAsset(string $name)
    {
        $this->_get('assets');
        foreach ($this->data as $a) {
            if ($a['name'] == $name) {
                return $a['id'];
            }
        }
    }

}



