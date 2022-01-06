<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssetsRequest;
use App\Http\Requests\UpdateAssetsRequest;
use App\Repositories\AssetsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AssetsController extends AppBaseController
{
    /** @var  AssetsRepository */
    private $assetsRepository;

    public function __construct(AssetsRepository $assetsRepo)
    {
        $this->assetsRepository = $assetsRepo;
    }

    /**
     * Display a listing of the Assets.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $assets = $this->assetsRepository->all();

        return view('assets.index')
            ->with('assets', $assets);
    }

    /**
     * Show the form for creating a new Assets.
     *
     * @return Response
     */
    public function create()
    {
        return view('assets.create');
    }

    /**
     * Store a newly created Assets in storage.
     *
     * @param CreateAssetsRequest $request
     *
     * @return Response
     */
    public function store(CreateAssetsRequest $request)
    {
        $input = $request->all();

        $assets = $this->assetsRepository->create($input);

        Flash::success('Assets saved successfully.');

        return redirect(route('assets.index'));
    }

    /**
     * Display the specified Assets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assets = $this->assetsRepository->find($id);

        if (empty($assets)) {
            Flash::error('Assets not found');

            return redirect(route('assets.index'));
        }

        return view('assets.show')->with('assets', $assets);
    }

    /**
     * Show the form for editing the specified Assets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assets = $this->assetsRepository->find($id);

        if (empty($assets)) {
            Flash::error('Assets not found');

            return redirect(route('assets.index'));
        }

        return view('assets.edit')->with('assets', $assets);
    }

    /**
     * Update the specified Assets in storage.
     *
     * @param int $id
     * @param UpdateAssetsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssetsRequest $request)
    {
        $assets = $this->assetsRepository->find($id);

        if (empty($assets)) {
            Flash::error('Assets not found');

            return redirect(route('assets.index'));
        }

        $assets = $this->assetsRepository->update($request->all(), $id);

        Flash::success('Assets updated successfully.');

        return redirect(route('assets.index'));
    }

    /**
     * Remove the specified Assets from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assets = $this->assetsRepository->find($id);

        if (empty($assets)) {
            Flash::error('Assets not found');

            return redirect(route('assets.index'));
        }

        $this->assetsRepository->delete($id);

        Flash::success('Assets deleted successfully.');

        return redirect(route('assets.index'));
    }
}
