<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePortfoliosRequest;
use App\Http\Requests\UpdatePortfoliosRequest;
use App\Repositories\PortfoliosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PortfoliosController extends AppBaseController
{
    /** @var  PortfoliosRepository */
    private $portfoliosRepository;

    public function __construct(PortfoliosRepository $portfoliosRepo)
    {
        $this->portfoliosRepository = $portfoliosRepo;
    }

    /**
     * Display a listing of the Portfolios.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $portfolios = $this->portfoliosRepository->all();

        return view('portfolios.index')
            ->with('portfolios', $portfolios);
    }

    /**
     * Show the form for creating a new Portfolios.
     *
     * @return Response
     */
    public function create()
    {
        return view('portfolios.create');
    }

    /**
     * Store a newly created Portfolios in storage.
     *
     * @param CreatePortfoliosRequest $request
     *
     * @return Response
     */
    public function store(CreatePortfoliosRequest $request)
    {
        $input = $request->all();

        $portfolios = $this->portfoliosRepository->create($input);

        Flash::success('Portfolios saved successfully.');

        return redirect(route('portfolios.index'));
    }

    /**
     * Display the specified Portfolios.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $portfolios = $this->portfoliosRepository->find($id);

        if (empty($portfolios)) {
            Flash::error('Portfolios not found');

            return redirect(route('portfolios.index'));
        }

        return view('portfolios.show')->with('portfolios', $portfolios);
    }

    /**
     * Show the form for editing the specified Portfolios.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $portfolios = $this->portfoliosRepository->find($id);

        if (empty($portfolios)) {
            Flash::error('Portfolios not found');

            return redirect(route('portfolios.index'));
        }

        return view('portfolios.edit')->with('portfolios', $portfolios);
    }

    /**
     * Update the specified Portfolios in storage.
     *
     * @param int $id
     * @param UpdatePortfoliosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePortfoliosRequest $request)
    {
        $portfolios = $this->portfoliosRepository->find($id);

        if (empty($portfolios)) {
            Flash::error('Portfolios not found');

            return redirect(route('portfolios.index'));
        }

        $portfolios = $this->portfoliosRepository->update($request->all(), $id);

        Flash::success('Portfolios updated successfully.');

        return redirect(route('portfolios.index'));
    }

    /**
     * Remove the specified Portfolios from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $portfolios = $this->portfoliosRepository->find($id);

        if (empty($portfolios)) {
            Flash::error('Portfolios not found');

            return redirect(route('portfolios.index'));
        }

        $this->portfoliosRepository->delete($id);

        Flash::success('Portfolios deleted successfully.');

        return redirect(route('portfolios.index'));
    }
}
