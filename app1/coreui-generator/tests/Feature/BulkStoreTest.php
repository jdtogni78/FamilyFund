<?php

namespace Tests\Feature;

use App\Models\AssetExt;
use Nette\Utils\DateTime;
use Tests\DataFactory;

trait BulkStoreTest
{
    use TimestampTest;
    use BulkStoreBaseTest;

    protected $field;
    protected $symbols;
    protected $updateObject;
    private $api;
    private $symbolFactory;
    private $requestFactory;
    private $source;
    private $cashTimestamp;

    private function setupBulkTest($field, $api, $symbolFactory, $reqFactory, $cashTs=null, $cashValue=null)
    {
        $df = new DataFactory();
        $df->createFund();
        $this->source = $df->portfolio->source;
        print_r("SETUP ".json_encode($df->portfolio)."\n");

        if ($cashTs == null)    $cashTs    = $df->cashPosition->start_dt;
        if ($cashValue == null) $cashValue = $df->cashPosition->position;

        $this->cashTimestamp = $cashTs;
        $this->cashValue = $cashValue;
        $this->setupTimestampTest();
        $this->field = $field;
        $this->api = $api;
        $this->symbolFactory = $symbolFactory;
        $this->requestFactory = $reqFactory;
    }

    public function testMissingFields()
    {
        $this->_testUnset('timestamp', 422);
        $this->_testUnset('source', 422);
        $this->_testUnsetSymbol('name', 422);
        $this->_testUnsetSymbol($this->field, 422);
    }

    public function testBasic()
    {
        $this->post = $post = $this->createSampleReq();
        $this->postAPI($post);
        $this->validateSampleRequest('validateUniqueHistorical');
    }

    public function testHistory()
    {
        $this->createSampleReq();
        $this->postAPI($this->post);

        $ts1 = $this->timestamp();
        $this->nextDay(4);
        $this->postAPI($this->post);
        $this->validateSampleRequest('validateUniqueHistorical', $ts1);

        $this->nextDay(1);
        $ts2 = $this->timestamp();
        $p2 = $this->post['symbols'][1];
        unset($this->post['symbols'][1]);
        $price1 = $this->post['symbols'][0][$this->field];
        $price2 = $this->post['symbols'][0][$this->field] = 11.11;
        $this->postAPI($this->post);

        $this->validateSampleRequest('validate2Historical', $ts1, $price1);

        $p1 = $this->post['symbols'][0];
        print_r(json_encode($this->post)."\n");
        $this->post['symbols'] = [$p2];
        print_r(json_encode($this->post)."\n");
        $this->validateSampleRequest('validateUniqueHistorical', $ts1);

        $this->prevDay();
        $this->prevDay();
        $this->prevDay();
        print_r(json_encode($this->post)."\n");
        unset($this->post['symbols'][0]);
        $this->post['symbols'] = [$p1];
        print_r(json_encode($this->post)."\n");
        $this->post['symbols'][0][$this->field] = 55.55;
        print_r(json_encode($this->post)."\n");
        $this->postAPI($this->post);

        $this->validateSampleRequest('validate3Historical', $ts1, $price1, $ts2, $price2);
    }

    protected function createSampleReq(): array
    {
        $this->symbols = $this->symbolFactory->count(2)->make();
        $this->updateObject = $this->requestFactory->make([
            'timestamp' => $this->timestamp(),
            'source'    => $this->source,
        ]);

        $assetsArr = $this->updateObject->toArray();
        $assetsArr['symbols'] = $this->symbols->toArray();
        $this->post = $assetsArr;
        return $assetsArr;
    }

    protected function validateSampleRequest($func, $ts1=null, $value1=null, $ts2=null, $value2=null): void
    {
        if ($ts1 == null) $ts1 = $this->post['timestamp'];

        foreach ($this->post['symbols'] as $symbol) {
            $symbol['source'] = $this->post['source'];

            $res = AssetExt::where('source', $this->post['source'])
                ->where('name', $symbol['name'])
                ->get();

            $this->assertCount(1, $res->toArray());
            $asset = $res->first();
            print_r(json_encode($asset) . "\n");

            $symbol['updated_at'] = $symbol['created_at'] = date('Y-m-d');
            $this->assertAssetSymbol($asset, $symbol);

            $aps = $this->getChildren($asset);
            $this->$func($aps, $this->field, $symbol['name'], $symbol[$this->field], $ts1, $value1, $ts2, $value2);
        }
        $this->validateNoChangeCash($this->cashTimestamp);
    }

    public function validateNoChangeCash($ts): void
    {
        $asset = AssetExt::where('name', 'CASH')->get()->first();
        $aps = $this->getChildren($asset);
        $this->validateUniqueHistorical($aps, $this->field, 'CASH', $this->cashValue,
            $ts);
    }


    protected function validate3Historical($collection, $field, $name, $expectedValue, $ts1, $value1, $ts2, $value2)
    {
        print_r(json_encode([$name, $ts1, $expectedValue, $ts2, $value2])."\n");
        $this->assertEquals(3, count($collection));
        foreach ($collection as $obj) {
            print_r(json_encode($obj)."\n");
            if ($this->compareTimestamp($obj->start_dt, $this->post['timestamp'])) { // middle record
                $this->assertTrue($this->compareTimestamp($obj->end_dt, $ts2));
                $this->assertEquals($expectedValue, $obj[$field]);
            } else if ($this->compareTimestamp($obj->start_dt, $ts1)) {
                $this->assertTrue($this->compareTimestamp($obj->end_dt, $this->post['timestamp']));
                $this->assertEquals($value1, $obj->$field);
            } else {
                $this->assertTrue($this->compareTimestamp($obj->start_dt, $ts2));
                $this->assertTrue($this->isInfinity($obj->end_dt));
                $this->assertEquals($value2, $obj->$field);
            }
        }
    }
    protected function validate2Historical($collection, $field, $name, $expectedValue, $oldTs, $oldExpectedValue, $ts2=null, $value2=null)
    {
        print_r(json_encode([$name, $oldTs, $expectedValue])."\n");
        $this->assertEquals(2, count($collection));
        foreach ($collection as $obj) {
            print_r(json_encode($obj)."\n");
            if ($this->compareTimestamp($obj->start_dt, $this->post['timestamp'])) {
                $this->assertEquals($expectedValue, $obj->$field);
                $this->assertTrue($this->isInfinity($obj->end_dt));
            } else {
                $this->assertEquals($oldExpectedValue, $obj->$field);
                $this->assertTrue($this->compareTimestamp($obj->start_dt, $oldTs));
                $this->assertTrue($this->compareTimestamp($obj->end_dt,   $this->post['timestamp']));
            }
        }
    }

    public function validateUniqueHistorical($collection, $field, $name, $expectedValue, $timestamp, $oldValue=null, $ts2=null, $value2=null): void
    {
        $count = count($collection);
        $this->assertEquals(1, $count);

        $count = 0;
        foreach ($collection as $obj) {
            print_r(json_encode($obj)."\n");
            if ($this->compareTimestamp($obj->start_dt, $timestamp)) {
                $this->assertEquals($obj->{$field}, $expectedValue);
                $this->assertTrue($this->isInfinity($obj->end_dt), "end_dt of $name is not infinity");
                $count++;
            }
        }
        $this->assertEquals(1, $count);
    }


}

