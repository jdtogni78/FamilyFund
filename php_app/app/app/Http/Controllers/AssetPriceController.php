<?php

namespace App\Http\Controllers;

use App\Models\AssetPrice;
use Illuminate\Http\Request;

/**
 * Class AssetPriceController
 * @package App\Http\Controllers
 */
class AssetPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetPrices = AssetPrice::paginate();

        return view('asset-price.index', compact('assetPrices'))
            ->with('i', (request()->input('page', 1) - 1) * $assetPrices->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assetPrice = new AssetPrice();
        return view('asset-price.create', compact('assetPrice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AssetPrice::$rules);

        $assetPrice = AssetPrice::create($request->all());

        return redirect()->route('asset-prices.index')
            ->with('success', 'AssetPrice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assetPrice = AssetPrice::find($id);

        return view('asset-price.show', compact('assetPrice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assetPrice = AssetPrice::find($id);

        return view('asset-price.edit', compact('assetPrice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AssetPrice $assetPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetPrice $assetPrice)
    {
        request()->validate(AssetPrice::$rules);

        $assetPrice->update($request->all());

        return redirect()->route('asset-prices.index')
            ->with('success', 'AssetPrice updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $assetPrice = AssetPrice::find($id)->delete();

        return redirect()->route('asset-prices.index')
            ->with('success', 'AssetPrice deleted successfully');
    }
}
