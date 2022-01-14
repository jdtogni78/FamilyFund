<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Repositories\PortfolioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PortfolioController extends AppBaseController
{
    /** @var  PortfolioRepository */
    protected $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepo)
    {
        $this->portfolioRepository = $portfolioRepo;
    }

    /**
     * Display a listing of the Portfolio.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $portfolios = $this->portfolioRepository->all();

        return view('portfolios.index')
            ->with('portfolios', $portfolios);
    }

    /**
     * Show the form for creating a new Portfolio.
     *
     * @return Response
     */
    public function create()
    {
        return view('portfolios.create');
    }

    /**
     * Store a newly created Portfolio in storage.
     *
     * @param CreatePortfolioRequest $request
     *
     * @return Response
     */
    public function store(CreatePortfolioRequest $request)
    {
        $input = $request->all();

        $portfolio = $this->portfolioRepository->create($input);

        Flash::success('Portfolio saved successfully.');

        return redirect(route('portfolios.index'));
    }

    /**
     * Display the specified Portfolio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $portfolio = $this->portfolioRepository->find($id);

        if (empty($portfolio)) {
            Flash::error('Portfolio not found');

            return redirect(route('portfolios.index'));
        }

        return view('portfolios.show')->with('portfolio', $portfolio);
    }

    /**
     * Show the form for editing the specified Portfolio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $portfolio = $this->portfolioRepository->find($id);

        if (empty($portfolio)) {
            Flash::error('Portfolio not found');

            return redirect(route('portfolios.index'));
        }

        return view('portfolios.edit')->with('portfolio', $portfolio);
    }

    /**
     * Update the specified Portfolio in storage.
     *
     * @param int $id
     * @param UpdatePortfolioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePortfolioRequest $request)
    {
        $portfolio = $this->portfolioRepository->find($id);

        if (empty($portfolio)) {
            Flash::error('Portfolio not found');

            return redirect(route('portfolios.index'));
        }

        $portfolio = $this->portfolioRepository->update($request->all(), $id);

        Flash::success('Portfolio updated successfully.');

        return redirect(route('portfolios.index'));
    }

    /**
     * Remove the specified Portfolio from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $portfolio = $this->portfolioRepository->find($id);

        if (empty($portfolio)) {
            Flash::error('Portfolio not found');

            return redirect(route('portfolios.index'));
        }

        $this->portfolioRepository->delete($id);

        Flash::success('Portfolio deleted successfully.');

        return redirect(route('portfolios.index'));
    }
}
