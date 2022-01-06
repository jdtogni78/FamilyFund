<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssetPricesRequest;
use App\Http\Requests\UpdateAssetPricesRequest;
use App\Repositories\AssetPricesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AssetPricesController extends AppBaseController
{
    /** @var  AssetPricesRepository */
    private $assetPricesRepository;

    public function __construct(AssetPricesRepository $assetPricesRepo)
    {
        $this->assetPricesRepository = $assetPricesRepo;
    }

    /**
     * Display a listing of the AssetPrices.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $assetPrices = $this->assetPricesRepository->all();

        return view('asset_prices.index')
            ->with('assetPrices', $assetPrices);
    }

    /**
     * Show the form for creating a new AssetPrices.
     *
     * @return Response
     */
    public function create()
    {
        return view('asset_prices.create');
    }

    /**
     * Store a newly created AssetPrices in storage.
     *
     * @param CreateAssetPricesRequest $request
     *
     * @return Response
     */
    public function store(CreateAssetPricesRequest $request)
    {
        $input = $request->all();

        $assetPrices = $this->assetPricesRepository->create($input);

        Flash::success('Asset Prices saved successfully.');

        return redirect(route('assetPrices.index'));
    }

    /**
     * Display the specified AssetPrices.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assetPrices = $this->assetPricesRepository->find($id);

        if (empty($assetPrices)) {
            Flash::error('Asset Prices not found');

            return redirect(route('assetPrices.index'));
        }

        return view('asset_prices.show')->with('assetPrices', $assetPrices);
    }

    /**
     * Show the form for editing the specified AssetPrices.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assetPrices = $this->assetPricesRepository->find($id);

        if (empty($assetPrices)) {
            Flash::error('Asset Prices not found');

            return redirect(route('assetPrices.index'));
        }

        return view('asset_prices.edit')->with('assetPrices', $assetPrices);
    }

    /**
     * Update the specified AssetPrices in storage.
     *
     * @param int $id
     * @param UpdateAssetPricesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssetPricesRequest $request)
    {
        $assetPrices = $this->assetPricesRepository->find($id);

        if (empty($assetPrices)) {
            Flash::error('Asset Prices not found');

            return redirect(route('assetPrices.index'));
        }

        $assetPrices = $this->assetPricesRepository->update($request->all(), $id);

        Flash::success('Asset Prices updated successfully.');

        return redirect(route('assetPrices.index'));
    }

    /**
     * Remove the specified AssetPrices from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assetPrices = $this->assetPricesRepository->find($id);

        if (empty($assetPrices)) {
            Flash::error('Asset Prices not found');

            return redirect(route('assetPrices.index'));
        }

        $this->assetPricesRepository->delete($id);

        Flash::success('Asset Prices deleted successfully.');

        return redirect(route('assetPrices.index'));
    }
}
