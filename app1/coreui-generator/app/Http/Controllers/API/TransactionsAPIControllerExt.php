<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTransactionsAPIRequest;
use App\Http\Requests\API\UpdateTransactionsAPIRequest;
use App\Models\Transactions;
use App\Models\TransactionAssets;
use App\Repositories\TransactionsRepository;
use App\Repositories\TransactionAssetsRepository;
use App\Repositories\AssetPricesRepository;
use App\Repositories\AssetsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\TransactionsAPIController;
use App\Http\Resources\TransactionsResource;
use Response;

/**
 * Class TransactionsControllerExt
 * @package App\Http\Controllers\API
 */

class TransactionsAPIControllerExt extends TransactionsAPIController
{
    public function __construct(TransactionsRepository $transactionsRepo)
    {
        parent::__construct($transactionsRepo);
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
        // $transactions->source;

        // PUR, BOR, SAL, REP
        $transactions->applyMatching($transactions);
        // $transactions->shares;
        // $transactions->account_id;
        // $transactions->matching_id;

        return $this->sendResponse(new TransactionsResource($transactions), 'Transactions saved successfully');
    }


}
