<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateterminosAPIRequest;
use App\Http\Requests\API\UpdateterminosAPIRequest;
use App\Models\terminos;
use App\Repositories\terminosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class terminosController
 * @package App\Http\Controllers\API
 */

class terminosAPIController extends AppBaseController
{
    /** @var  terminosRepository */
    private $terminosRepository;

    public function __construct(terminosRepository $terminosRepo)
    {
        $this->terminosRepository = $terminosRepo;
    }

    /**
     * Display a listing of the terminos.
     * GET|HEAD /terminos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->terminosRepository->pushCriteria(new RequestCriteria($request));
        $this->terminosRepository->pushCriteria(new LimitOffsetCriteria($request));
        $terminos = $this->terminosRepository->all();

        return $this->sendResponse($terminos->toArray(), 'Terminos retrieved successfully');
    }

    /**
     * Store a newly created terminos in storage.
     * POST /terminos
     *
     * @param CreateterminosAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateterminosAPIRequest $request)
    {
        $input = $request->all();

        $terminos = $this->terminosRepository->create($input);

        return $this->sendResponse($terminos->toArray(), 'Terminos saved successfully');
    }

    /**
     * Display the specified terminos.
     * GET|HEAD /terminos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var terminos $terminos */
        $terminos = $this->terminosRepository->findWithoutFail($id);

        if (empty($terminos)) {
            return $this->sendError('Terminos not found');
        }

        return $this->sendResponse($terminos->toArray(), 'Terminos retrieved successfully');
    }

    /**
     * Update the specified terminos in storage.
     * PUT/PATCH /terminos/{id}
     *
     * @param  int $id
     * @param UpdateterminosAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateterminosAPIRequest $request)
    {
        $input = $request->all();

        /** @var terminos $terminos */
        $terminos = $this->terminosRepository->findWithoutFail($id);

        if (empty($terminos)) {
            return $this->sendError('Terminos not found');
        }

        $terminos = $this->terminosRepository->update($input, $id);

        return $this->sendResponse($terminos->toArray(), 'terminos updated successfully');
    }

    /**
     * Remove the specified terminos from storage.
     * DELETE /terminos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var terminos $terminos */
        $terminos = $this->terminosRepository->findWithoutFail($id);

        if (empty($terminos)) {
            return $this->sendError('Terminos not found');
        }

        $terminos->delete();

        return $this->sendResponse($id, 'Terminos deleted successfully');
    }
}
