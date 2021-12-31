<?php

namespace App\Http\Controllers;

use App\Models\PortfolioAsset;
use Illuminate\Http\Request;

/**
 * Class PortfolioAssetController
 * @package App\Http\Controllers
 */
class PortfolioAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolioAssets = PortfolioAsset::paginate();

        return view('portfolio-asset.index', compact('portfolioAssets'))
            ->with('i', (request()->input('page', 1) - 1) * $portfolioAssets->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $portfolioAsset = new PortfolioAsset();
        return view('portfolio-asset.create', compact('portfolioAsset'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PortfolioAsset::$rules);

        $portfolioAsset = PortfolioAsset::create($request->all());

        return redirect()->route('portfolio-assets.index')
            ->with('success', 'PortfolioAsset created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolioAsset = PortfolioAsset::find($id);

        return view('portfolio-asset.show', compact('portfolioAsset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolioAsset = PortfolioAsset::find($id);

        return view('portfolio-asset.edit', compact('portfolioAsset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PortfolioAsset $portfolioAsset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortfolioAsset $portfolioAsset)
    {
        request()->validate(PortfolioAsset::$rules);

        $portfolioAsset->update($request->all());

        return redirect()->route('portfolio-assets.index')
            ->with('success', 'PortfolioAsset updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $portfolioAsset = PortfolioAsset::find($id)->delete();

        return redirect()->route('portfolio-assets.index')
            ->with('success', 'PortfolioAsset deleted successfully');
    }
}
