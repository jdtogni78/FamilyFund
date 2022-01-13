<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTransactionsAPIRequest;
use App\Http\Requests\API\UpdateTransactionsAPIRequest;
use App\Models\Transactions;
use App\Repositories\TransactionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TransactionsResource;
use Response;

/**
 * Class TransactionsController
 * @package App\Http\Controllers\API
 */

class TransactionsAPIController extends AppBaseController
{
    /** @var  TransactionsRepository */
    protected $transactionsRepository;

    public function __construct(TransactionsRepository $transactionsRepo)
    {
        $this->transactionsRepository = $transactionsRepo;
    }

    /**
     * Display a listing of the Transactions.
     * GET|HEAD /transactions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $transactions = $this->transactionsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TransactionsResource::collection($transactions), 'Transactions retrieved successfully');
    }

    /**
     * Store a newly created Transactions in storage.
     * POST /transactions
     *
     * @param CreateTransactionsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTransactionsAPIRequest $request)
    {
        $input = $request->all();

        $transactions = $this->transactionsRepository->create($input);

        return $this->sendResponse(new TransactionsResource($transactions), 'Transactions saved successfully');
    }

    /**
     * Display the specified Transactions.
     * GET|HEAD /transactions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Transactions $transactions */
        $transactions = $this->transactionsRepository->find($id);

        if (empty($transactions)) {
            return $this->sendError('Transactions not found');
        }

        return $this->sendResponse(new TransactionsResource($transactions), 'Transactions retrieved successfully');
    }

    /**
     * Update the specified Transactions in storage.
     * PUT/PATCH /transactions/{id}
     *
     * @param int $id
     * @param UpdateTransactionsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransactionsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transactions $transactions */
        $transactions = $this->transactionsRepository->find($id);

        if (empty($transactions)) {
            return $this->sendError('Transactions not found');
        }

        $transactions = $this->transactionsRepository->update($input, $id);

        return $this->sendResponse(new TransactionsResource($transactions), 'Transactions updated successfully');
    }

    /**
     * Remove the specified Transactions from storage.
     * DELETE /transactions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Transactions $transactions */
        $transactions = $this->transactionsRepository->find($id);

        if (empty($transactions)) {
            return $this->sendError('Transactions not found');
        }

        $transactions->delete();

        return $this->sendSuccess('Transactions deleted successfully');
    }
}
