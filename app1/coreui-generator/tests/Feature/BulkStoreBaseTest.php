<?php

namespace Tests\Feature;

trait BulkStoreBaseTest
{

    protected function postError(array $assetsArr, $error_code = 422): void
    {
        print_r("*** postError: " . json_encode($assetsArr)."\n");
        $this->response = $this->json('POST', $this->api, $assetsArr);
        $this->assertApiError($error_code);
    }

    protected function postAPI(array $post): void
    {
        print_r("*** postAPI: " . json_encode($post)."\n");
        $this->response = $this->json('POST', $this->api, $post);
        $this->assertEmptyData();
        $this->assertApiSuccess();
    }


    protected function assertEmptyData()
    {
        print_r($this->response->content()."\n");
        $res = json_decode($this->response->content());
        $this->assertEmpty($res->data);
    }


    public function _testUnsetSymbol($key, $error_code)
    {
        $assetsArr = $this->createSampleReq();
        foreach ($assetsArr['symbols'] as &$symbol) {
            unset($symbol[$key]);
        }

        $this->postError($assetsArr, $error_code);
    }

    public function _testUnset($key, $error_code)
    {
        $assetsArr = $this->createSampleReq();
        unset($assetsArr[$key]);

        $this->postError($assetsArr, $error_code);
    }


    protected function makeSymbol($name=null, $type=null): array
    {
        $values = [];
        if ($name) $values['name'] = $name;
        if ($type) $values['type'] = $type;
        return $this->symbolFactory->make($values)->toArray();
    }

    private function assertAssetSymbol($asset, mixed $symbol)
    {
        $this->assertEquals($asset->source, $symbol['source']);
        $this->assertEquals($asset->name, $symbol['name']);
        $this->assertEquals($asset->type, $symbol['type']);
        if (array_key_exists('created_at', $symbol))  $this->assertDate($asset->created_at,  $symbol['created_at']);
        if (array_key_exists('updated_at', $symbol))  $this->assertDate($asset->updated_at,  $symbol['updated_at']);
    }

}
