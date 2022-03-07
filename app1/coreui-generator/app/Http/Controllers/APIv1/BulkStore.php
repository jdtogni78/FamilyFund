<?php

namespace App\Http\Controllers\APIv1;

use App\Models\AssetExt;
use App\Models\AssetPrice;
use App\Models\PortfolioAsset;
use Nette\Schema\ValidationException;

trait BulkStore
{
    protected abstract function getQuery($source, $asset, $timestamp);
    protected abstract function createChild($data, $source);

    public function genericBulkStore($request, $field)
    {
        $input = $request->all();
        $symbols = $request->collect('symbols')->toArray();
        $timestamp = $input['timestamp'];
        $source = $input['source'];

        foreach ($symbols as $symbol) {
            $symbol['source'] = $source;
            $input = array_intersect_key($symbol, array_flip((new AssetExt())->fillable));
            $asset = AssetExt::firstOrCreate($input);
            $this->insertHistorical($source, $asset->id, $timestamp, $symbol[$field], $field);
        }
        return $this->sendResponse([], 'Bulk ' . $field . ' update successful!');
    }

    public function insertHistorical($source, $assetId, $timestamp, $newValue, $field): PortfolioAsset|AssetPrice
    {
        $asset = AssetExt::find($assetId);
        if ($asset == null) {
            throw new ValidationException("Invalid asset provided: " . $assetId);
        }
        $query = $this->getQuery($source, $asset, $timestamp);

        $ret = null;
        $create = true;
        $newEnd = null;
        if (!$query->isEmpty()) {
            $create = false;
            foreach ($query as $obj) {
                // value changed, lets end & create new
                if ($obj->$field != $newValue) {
                    $newEnd = $obj->end_dt; // in case thats not the last record
                    print_r("newend: " . json_encode($obj) . "\n");
                    $obj->end_dt = $timestamp;
                    $obj->save();
                    $create = true;
                } else {
                    $ret = $obj;
                }
            }
        }
        if ($create) {
            $data = $this->getChildData($asset, $newValue, $timestamp, $newEnd, $field);
            $ret = $this->createChild($data, $source);
        }
        return $ret;
    }

    protected function getChildData($asset, $newValue, $timestamp, $endDt, $field): array
    {
        $data = [
            'asset_id' => $asset->id,
            $field => $newValue,
            'start_dt' => $timestamp,
        ];
        if ($endDt) $data['end_dt'] = $endDt;
        return $data;
    }

}
