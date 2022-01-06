<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFundsRequest;
use App\Http\Requests\UpdateFundsRequest;
use App\Repositories\FundsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FundsController extends AppBaseController
{
    /** @var  FundsRepository */
    private $fundsRepository;

    public function __construct(FundsRepository $fundsRepo)
    {
        $this->fundsRepository = $fundsRepo;
    }

    /**
     * Display a listing of the Funds.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $funds = $this->fundsRepository->all();

        return view('funds.index')
            ->with('funds', $funds);
    }

    /**
     * Show the form for creating a new Funds.
     *
     * @return Response
     */
    public function create()
    {
        return view('funds.create');
    }

    /**
     * Store a newly created Funds in storage.
     *
     * @param CreateFundsRequest $request
     *
     * @return Response
     */
    public function store(CreateFundsRequest $request)
    {
        $input = $request->all();

        $funds = $this->fundsRepository->create($input);

        Flash::success('Funds saved successfully.');

        return redirect(route('funds.index'));
    }

    /**
     * Display the specified Funds.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $funds = $this->fundsRepository->find($id);

        if (empty($funds)) {
            Flash::error('Funds not found');

            return redirect(route('funds.index'));
        }

        return view('funds.show')->with('funds', $funds);
    }

    /**
     * Show the form for editing the specified Funds.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $funds = $this->fundsRepository->find($id);

        if (empty($funds)) {
            Flash::error('Funds not found');

            return redirect(route('funds.index'));
        }

        return view('funds.edit')->with('funds', $funds);
    }

    /**
     * Update the specified Funds in storage.
     *
     * @param int $id
     * @param UpdateFundsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFundsRequest $request)
    {
        $funds = $this->fundsRepository->find($id);

        if (empty($funds)) {
            Flash::error('Funds not found');

            return redirect(route('funds.index'));
        }

        $funds = $this->fundsRepository->update($request->all(), $id);

        Flash::success('Funds updated successfully.');

        return redirect(route('funds.index'));
    }

    /**
     * Remove the specified Funds from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $funds = $this->fundsRepository->find($id);

        if (empty($funds)) {
            Flash::error('Funds not found');

            return redirect(route('funds.index'));
        }

        $this->fundsRepository->delete($id);

        Flash::success('Funds deleted successfully.');

        return redirect(route('funds.index'));
    }
}
