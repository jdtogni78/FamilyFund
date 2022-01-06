<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMatchingRulesAPIRequest;
use App\Http\Requests\API\UpdateMatchingRulesAPIRequest;
use App\Models\MatchingRules;
use App\Repositories\MatchingRulesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\MatchingRulesResource;
use Response;

/**
 * Class MatchingRulesController
 * @package App\Http\Controllers\API
 */

class MatchingRulesAPIController extends AppBaseController
{
    /** @var  MatchingRulesRepository */
    private $matchingRulesRepository;

    public function __construct(MatchingRulesRepository $matchingRulesRepo)
    {
        $this->matchingRulesRepository = $matchingRulesRepo;
    }

    /**
     * Display a listing of the MatchingRules.
     * GET|HEAD /matchingRules
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $matchingRules = $this->matchingRulesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(MatchingRulesResource::collection($matchingRules), 'Matching Rules retrieved successfully');
    }

    /**
     * Store a newly created MatchingRules in storage.
     * POST /matchingRules
     *
     * @param CreateMatchingRulesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMatchingRulesAPIRequest $request)
    {
        $input = $request->all();

        $matchingRules = $this->matchingRulesRepository->create($input);

        return $this->sendResponse(new MatchingRulesResource($matchingRules), 'Matching Rules saved successfully');
    }

    /**
     * Display the specified MatchingRules.
     * GET|HEAD /matchingRules/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MatchingRules $matchingRules */
        $matchingRules = $this->matchingRulesRepository->find($id);

        if (empty($matchingRules)) {
            return $this->sendError('Matching Rules not found');
        }

        return $this->sendResponse(new MatchingRulesResource($matchingRules), 'Matching Rules retrieved successfully');
    }

    /**
     * Update the specified MatchingRules in storage.
     * PUT/PATCH /matchingRules/{id}
     *
     * @param int $id
     * @param UpdateMatchingRulesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMatchingRulesAPIRequest $request)
    {
        $input = $request->all();

        /** @var MatchingRules $matchingRules */
        $matchingRules = $this->matchingRulesRepository->find($id);

        if (empty($matchingRules)) {
            return $this->sendError('Matching Rules not found');
        }

        $matchingRules = $this->matchingRulesRepository->update($input, $id);

        return $this->sendResponse(new MatchingRulesResource($matchingRules), 'MatchingRules updated successfully');
    }

    /**
     * Remove the specified MatchingRules from storage.
     * DELETE /matchingRules/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MatchingRules $matchingRules */
        $matchingRules = $this->matchingRulesRepository->find($id);

        if (empty($matchingRules)) {
            return $this->sendError('Matching Rules not found');
        }

        $matchingRules->delete();

        return $this->sendSuccess('Matching Rules deleted successfully');
    }
}
