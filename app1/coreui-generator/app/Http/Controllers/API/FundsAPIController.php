<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFundsAPIRequest;
use App\Http\Requests\API\UpdateFundsAPIRequest;
use App\Models\Funds;
use App\Repositories\FundsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FundsResource;
use Response;

/**
 * Class FundsController
 * @package App\Http\Controllers\API
 */

class FundsAPIController extends AppBaseController
{
    /** @var  FundsRepository */
    private $fundsRepository;

    public function __construct(FundsRepository $fundsRepo)
    {
        $this->fundsRepository = $fundsRepo;
    }

    /**
     * Display a listing of the Funds.
     * GET|HEAD /funds
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $funds = $this->fundsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(FundsResource::collection($funds), 'Funds retrieved successfully');
    }

    /**
     * Store a newly created Funds in storage.
     * POST /funds
     *
     * @param CreateFundsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFundsAPIRequest $request)
    {
        $input = $request->all();

        $funds = $this->fundsRepository->create($input);

        return $this->sendResponse(new FundsResource($funds), 'Funds saved successfully');
    }

    /**
     * Display the specified Funds.
     * GET|HEAD /funds/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Funds $funds */
        $funds = $this->fundsRepository->find($id);

        if (empty($funds)) {
            return $this->sendError('Funds not found');
        }

        return $this->sendResponse(new FundsResource($funds), 'Funds retrieved successfully');
    }

    /**
     * Update the specified Funds in storage.
     * PUT/PATCH /funds/{id}
     *
     * @param int $id
     * @param UpdateFundsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFundsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Funds $funds */
        $funds = $this->fundsRepository->find($id);

        if (empty($funds)) {
            return $this->sendError('Funds not found');
        }

        $funds = $this->fundsRepository->update($input, $id);

        return $this->sendResponse(new FundsResource($funds), 'Funds updated successfully');
    }

    /**
     * Remove the specified Funds from storage.
     * DELETE /funds/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Funds $funds */
        $funds = $this->fundsRepository->find($id);

        if (empty($funds)) {
            return $this->sendError('Funds not found');
        }

        $funds->delete();

        return $this->sendSuccess('Funds deleted successfully');
    }
}
