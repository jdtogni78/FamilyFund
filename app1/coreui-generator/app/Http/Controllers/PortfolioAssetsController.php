<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePortfolioAssetsRequest;
use App\Http\Requests\UpdatePortfolioAssetsRequest;
use App\Repositories\PortfolioAssetsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PortfolioAssetsController extends AppBaseController
{
    /** @var  PortfolioAssetsRepository */
    private $portfolioAssetsRepository;

    public function __construct(PortfolioAssetsRepository $portfolioAssetsRepo)
    {
        $this->portfolioAssetsRepository = $portfolioAssetsRepo;
    }

    /**
     * Display a listing of the PortfolioAssets.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $portfolioAssets = $this->portfolioAssetsRepository->all();

        return view('portfolio_assets.index')
            ->with('portfolioAssets', $portfolioAssets);
    }

    /**
     * Show the form for creating a new PortfolioAssets.
     *
     * @return Response
     */
    public function create()
    {
        return view('portfolio_assets.create');
    }

    /**
     * Store a newly created PortfolioAssets in storage.
     *
     * @param CreatePortfolioAssetsRequest $request
     *
     * @return Response
     */
    public function store(CreatePortfolioAssetsRequest $request)
    {
        $input = $request->all();

        $portfolioAssets = $this->portfolioAssetsRepository->create($input);

        Flash::success('Portfolio Assets saved successfully.');

        return redirect(route('portfolioAssets.index'));
    }

    /**
     * Display the specified PortfolioAssets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $portfolioAssets = $this->portfolioAssetsRepository->find($id);

        if (empty($portfolioAssets)) {
            Flash::error('Portfolio Assets not found');

            return redirect(route('portfolioAssets.index'));
        }

        return view('portfolio_assets.show')->with('portfolioAssets', $portfolioAssets);
    }

    /**
     * Show the form for editing the specified PortfolioAssets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $portfolioAssets = $this->portfolioAssetsRepository->find($id);

        if (empty($portfolioAssets)) {
            Flash::error('Portfolio Assets not found');

            return redirect(route('portfolioAssets.index'));
        }

        return view('portfolio_assets.edit')->with('portfolioAssets', $portfolioAssets);
    }

    /**
     * Update the specified PortfolioAssets in storage.
     *
     * @param int $id
     * @param UpdatePortfolioAssetsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePortfolioAssetsRequest $request)
    {
        $portfolioAssets = $this->portfolioAssetsRepository->find($id);

        if (empty($portfolioAssets)) {
            Flash::error('Portfolio Assets not found');

            return redirect(route('portfolioAssets.index'));
        }

        $portfolioAssets = $this->portfolioAssetsRepository->update($request->all(), $id);

        Flash::success('Portfolio Assets updated successfully.');

        return redirect(route('portfolioAssets.index'));
    }

    /**
     * Remove the specified PortfolioAssets from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $portfolioAssets = $this->portfolioAssetsRepository->find($id);

        if (empty($portfolioAssets)) {
            Flash::error('Portfolio Assets not found');

            return redirect(route('portfolioAssets.index'));
        }

        $this->portfolioAssetsRepository->delete($id);

        Flash::success('Portfolio Assets deleted successfully.');

        return redirect(route('portfolioAssets.index'));
    }
}
