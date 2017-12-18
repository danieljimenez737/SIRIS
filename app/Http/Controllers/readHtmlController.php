<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatereadHtmlRequest;
use App\Http\Requests\UpdatereadHtmlRequest;
use App\Repositories\readHtmlRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class readHtmlController extends AppBaseController
{
    /** @var  readHtmlRepository */
    private $readHtmlRepository;

    public function __construct(readHtmlRepository $readHtmlRepo)
    {
        $this->readHtmlRepository = $readHtmlRepo;
    }

    /**
     * Display a listing of the readHtml.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->readHtmlRepository->pushCriteria(new RequestCriteria($request));
        $readHtmls = $this->readHtmlRepository->all();

        return view('read_htmls.index')
            ->with('readHtmls', $readHtmls);
    }

    /**
     * Show the form for creating a new readHtml.
     *
     * @return Response
     */
    public function create()
    {
        return view('read_htmls.create');
    }

    /**
     * Store a newly created readHtml in storage.
     *
     * @param CreatereadHtmlRequest $request
     *
     * @return Response
     */
    public function store(CreatereadHtmlRequest $request)
    {
        $input = $request->all();

        $readHtml = $this->readHtmlRepository->create($input);

        Flash::success('Read Html saved successfully.');

        return redirect(route('readHtmls.index'));
    }

    /**
     * Display the specified readHtml.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $readHtml = $this->readHtmlRepository->findWithoutFail($id);

        if (empty($readHtml)) {
            Flash::error('Read Html not found');

            return redirect(route('readHtmls.index'));
        }

        return view('read_htmls.show')->with('readHtml', $readHtml);
    }

    /**
     * Show the form for editing the specified readHtml.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $readHtml = $this->readHtmlRepository->findWithoutFail($id);

        if (empty($readHtml)) {
            Flash::error('Read Html not found');

            return redirect(route('readHtmls.index'));
        }

        return view('read_htmls.edit')->with('readHtml', $readHtml);
    }

    /**
     * Update the specified readHtml in storage.
     *
     * @param  int              $id
     * @param UpdatereadHtmlRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatereadHtmlRequest $request)
    {
        $readHtml = $this->readHtmlRepository->findWithoutFail($id);

        if (empty($readHtml)) {
            Flash::error('Read Html not found');

            return redirect(route('readHtmls.index'));
        }

        $readHtml = $this->readHtmlRepository->update($request->all(), $id);

        Flash::success('Read Html updated successfully.');

        return redirect(route('readHtmls.index'));
    }

    /**
     * Remove the specified readHtml from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $readHtml = $this->readHtmlRepository->findWithoutFail($id);

        if (empty($readHtml)) {
            Flash::error('Read Html not found');

            return redirect(route('readHtmls.index'));
        }

        $this->readHtmlRepository->delete($id);

        Flash::success('Read Html deleted successfully.');

        return redirect(route('readHtmls.index'));
    }
}
