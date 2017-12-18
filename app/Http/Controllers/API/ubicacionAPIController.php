<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateubicacionAPIRequest;
use App\Http\Requests\API\UpdateubicacionAPIRequest;
use App\Models\ubicacion;
use App\Repositories\ubicacionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ubicacionController
 * @package App\Http\Controllers\API
 */

class ubicacionAPIController extends AppBaseController
{
    /** @var  ubicacionRepository */
    private $ubicacionRepository;

    public function __construct(ubicacionRepository $ubicacionRepo)
    {
        $this->ubicacionRepository = $ubicacionRepo;
    }

    /**
     * Display a listing of the ubicacion.
     * GET|HEAD /ubicacions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->ubicacionRepository->pushCriteria(new RequestCriteria($request));
        $this->ubicacionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $ubicacions = $this->ubicacionRepository->all();

        return $this->sendResponse($ubicacions->toArray(), 'Ubicacions retrieved successfully');
    }

    /**
     * Store a newly created ubicacion in storage.
     * POST /ubicacions
     *
     * @param CreateubicacionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateubicacionAPIRequest $request)
    {
        $input = $request->all();

        $ubicacions = $this->ubicacionRepository->create($input);

        return $this->sendResponse($ubicacions->toArray(), 'Ubicacion saved successfully');
    }

    /**
     * Display the specified ubicacion.
     * GET|HEAD /ubicacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ubicacion $ubicacion */
        $ubicacion = $this->ubicacionRepository->findWithoutFail($id);

        if (empty($ubicacion)) {
            return $this->sendError('Ubicacion not found');
        }

        return $this->sendResponse($ubicacion->toArray(), 'Ubicacion retrieved successfully');
    }

    /**
     * Update the specified ubicacion in storage.
     * PUT/PATCH /ubicacions/{id}
     *
     * @param  int $id
     * @param UpdateubicacionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateubicacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var ubicacion $ubicacion */
        $ubicacion = $this->ubicacionRepository->findWithoutFail($id);

        if (empty($ubicacion)) {
            return $this->sendError('Ubicacion not found');
        }

        $ubicacion = $this->ubicacionRepository->update($input, $id);

        return $this->sendResponse($ubicacion->toArray(), 'ubicacion updated successfully');
    }

    /**
     * Remove the specified ubicacion from storage.
     * DELETE /ubicacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ubicacion $ubicacion */
        $ubicacion = $this->ubicacionRepository->findWithoutFail($id);

        if (empty($ubicacion)) {
            return $this->sendError('Ubicacion not found');
        }

        $ubicacion->delete();

        return $this->sendResponse($id, 'Ubicacion deleted successfully');
    }
}
