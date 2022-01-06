<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMatchingRulesRequest;
use App\Http\Requests\UpdateMatchingRulesRequest;
use App\Repositories\MatchingRulesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MatchingRulesController extends AppBaseController
{
    /** @var  MatchingRulesRepository */
    private $matchingRulesRepository;

    public function __construct(MatchingRulesRepository $matchingRulesRepo)
    {
        $this->matchingRulesRepository = $matchingRulesRepo;
    }

    /**
     * Display a listing of the MatchingRules.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $matchingRules = $this->matchingRulesRepository->all();

        return view('matching_rules.index')
            ->with('matchingRules', $matchingRules);
    }

    /**
     * Show the form for creating a new MatchingRules.
     *
     * @return Response
     */
    public function create()
    {
        return view('matching_rules.create');
    }

    /**
     * Store a newly created MatchingRules in storage.
     *
     * @param CreateMatchingRulesRequest $request
     *
     * @return Response
     */
    public function store(CreateMatchingRulesRequest $request)
    {
        $input = $request->all();

        $matchingRules = $this->matchingRulesRepository->create($input);

        Flash::success('Matching Rules saved successfully.');

        return redirect(route('matchingRules.index'));
    }

    /**
     * Display the specified MatchingRules.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $matchingRules = $this->matchingRulesRepository->find($id);

        if (empty($matchingRules)) {
            Flash::error('Matching Rules not found');

            return redirect(route('matchingRules.index'));
        }

        return view('matching_rules.show')->with('matchingRules', $matchingRules);
    }

    /**
     * Show the form for editing the specified MatchingRules.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $matchingRules = $this->matchingRulesRepository->find($id);

        if (empty($matchingRules)) {
            Flash::error('Matching Rules not found');

            return redirect(route('matchingRules.index'));
        }

        return view('matching_rules.edit')->with('matchingRules', $matchingRules);
    }

    /**
     * Update the specified MatchingRules in storage.
     *
     * @param int $id
     * @param UpdateMatchingRulesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMatchingRulesRequest $request)
    {
        $matchingRules = $this->matchingRulesRepository->find($id);

        if (empty($matchingRules)) {
            Flash::error('Matching Rules not found');

            return redirect(route('matchingRules.index'));
        }

        $matchingRules = $this->matchingRulesRepository->update($request->all(), $id);

        Flash::success('Matching Rules updated successfully.');

        return redirect(route('matchingRules.index'));
    }

    /**
     * Remove the specified MatchingRules from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $matchingRules = $this->matchingRulesRepository->find($id);

        if (empty($matchingRules)) {
            Flash::error('Matching Rules not found');

            return redirect(route('matchingRules.index'));
        }

        $this->matchingRulesRepository->delete($id);

        Flash::success('Matching Rules deleted successfully.');

        return redirect(route('matchingRules.index'));
    }
}
