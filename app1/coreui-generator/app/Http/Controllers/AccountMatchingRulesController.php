<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountMatchingRulesRequest;
use App\Http\Requests\UpdateAccountMatchingRulesRequest;
use App\Repositories\AccountMatchingRulesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AccountMatchingRulesController extends AppBaseController
{
    /** @var  AccountMatchingRulesRepository */
    private $accountMatchingRulesRepository;

    public function __construct(AccountMatchingRulesRepository $accountMatchingRulesRepo)
    {
        $this->accountMatchingRulesRepository = $accountMatchingRulesRepo;
    }

    /**
     * Display a listing of the AccountMatchingRules.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $accountMatchingRules = $this->accountMatchingRulesRepository->all();

        return view('account_matching_rules.index')
            ->with('accountMatchingRules', $accountMatchingRules);
    }

    /**
     * Show the form for creating a new AccountMatchingRules.
     *
     * @return Response
     */
    public function create()
    {
        return view('account_matching_rules.create');
    }

    /**
     * Store a newly created AccountMatchingRules in storage.
     *
     * @param CreateAccountMatchingRulesRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountMatchingRulesRequest $request)
    {
        $input = $request->all();

        $accountMatchingRules = $this->accountMatchingRulesRepository->create($input);

        Flash::success('Account Matching Rules saved successfully.');

        return redirect(route('accountMatchingRules.index'));
    }

    /**
     * Display the specified AccountMatchingRules.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accountMatchingRules = $this->accountMatchingRulesRepository->find($id);

        if (empty($accountMatchingRules)) {
            Flash::error('Account Matching Rules not found');

            return redirect(route('accountMatchingRules.index'));
        }

        return view('account_matching_rules.show')->with('accountMatchingRules', $accountMatchingRules);
    }

    /**
     * Show the form for editing the specified AccountMatchingRules.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accountMatchingRules = $this->accountMatchingRulesRepository->find($id);

        if (empty($accountMatchingRules)) {
            Flash::error('Account Matching Rules not found');

            return redirect(route('accountMatchingRules.index'));
        }

        return view('account_matching_rules.edit')->with('accountMatchingRules', $accountMatchingRules);
    }

    /**
     * Update the specified AccountMatchingRules in storage.
     *
     * @param int $id
     * @param UpdateAccountMatchingRulesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountMatchingRulesRequest $request)
    {
        $accountMatchingRules = $this->accountMatchingRulesRepository->find($id);

        if (empty($accountMatchingRules)) {
            Flash::error('Account Matching Rules not found');

            return redirect(route('accountMatchingRules.index'));
        }

        $accountMatchingRules = $this->accountMatchingRulesRepository->update($request->all(), $id);

        Flash::success('Account Matching Rules updated successfully.');

        return redirect(route('accountMatchingRules.index'));
    }

    /**
     * Remove the specified AccountMatchingRules from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accountMatchingRules = $this->accountMatchingRulesRepository->find($id);

        if (empty($accountMatchingRules)) {
            Flash::error('Account Matching Rules not found');

            return redirect(route('accountMatchingRules.index'));
        }

        $this->accountMatchingRulesRepository->delete($id);

        Flash::success('Account Matching Rules deleted successfully.');

        return redirect(route('accountMatchingRules.index'));
    }
}
