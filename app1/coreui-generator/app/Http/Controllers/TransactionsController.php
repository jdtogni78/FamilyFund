<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionsRequest;
use App\Http\Requests\UpdateTransactionsRequest;
use App\Repositories\TransactionsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TransactionsController extends AppBaseController
{
    /** @var  TransactionsRepository */
    private $transactionsRepository;

    public function __construct(TransactionsRepository $transactionsRepo)
    {
        $this->transactionsRepository = $transactionsRepo;
    }

    /**
     * Display a listing of the Transactions.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $transactions = $this->transactionsRepository->all();

        return view('transactions.index')
            ->with('transactions', $transactions);
    }

    /**
     * Show the form for creating a new Transactions.
     *
     * @return Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created Transactions in storage.
     *
     * @param CreateTransactionsRequest $request
     *
     * @return Response
     */
    public function store(CreateTransactionsRequest $request)
    {
        $input = $request->all();

        $transactions = $this->transactionsRepository->create($input);

        Flash::success('Transactions saved successfully.');

        return redirect(route('transactions.index'));
    }

    /**
     * Display the specified Transactions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transactions = $this->transactionsRepository->find($id);

        if (empty($transactions)) {
            Flash::error('Transactions not found');

            return redirect(route('transactions.index'));
        }

        return view('transactions.show')->with('transactions', $transactions);
    }

    /**
     * Show the form for editing the specified Transactions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transactions = $this->transactionsRepository->find($id);

        if (empty($transactions)) {
            Flash::error('Transactions not found');

            return redirect(route('transactions.index'));
        }

        return view('transactions.edit')->with('transactions', $transactions);
    }

    /**
     * Update the specified Transactions in storage.
     *
     * @param int $id
     * @param UpdateTransactionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransactionsRequest $request)
    {
        $transactions = $this->transactionsRepository->find($id);

        if (empty($transactions)) {
            Flash::error('Transactions not found');

            return redirect(route('transactions.index'));
        }

        $transactions = $this->transactionsRepository->update($request->all(), $id);

        Flash::success('Transactions updated successfully.');

        return redirect(route('transactions.index'));
    }

    /**
     * Remove the specified Transactions from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transactions = $this->transactionsRepository->find($id);

        if (empty($transactions)) {
            Flash::error('Transactions not found');

            return redirect(route('transactions.index'));
        }

        $this->transactionsRepository->delete($id);

        Flash::success('Transactions deleted successfully.');

        return redirect(route('transactions.index'));
    }
}
