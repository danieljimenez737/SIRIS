<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedocumentoAPIRequest;
use App\Http\Requests\API\UpdatedocumentoAPIRequest;
use App\Models\documento;
use App\Repositories\documentoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class documentoController
 * @package App\Http\Controllers\API
 */

class documentoAPIController extends AppBaseController
{
    /** @var  documentoRepository */
    private $documentoRepository;

    public function __construct(documentoRepository $documentoRepo)
    {
        $this->documentoRepository = $documentoRepo;
    }

    /**
     * Display a listing of the documento.
     * GET|HEAD /documentos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->documentoRepository->pushCriteria(new RequestCriteria($request));
        $this->documentoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $documentos = $this->documentoRepository->all();

        return $this->sendResponse($documentos->toArray(), 'Documentos retrieved successfully');
    }

    /**
     * Store a newly created documento in storage.
     * POST /documentos
     *
     * @param CreatedocumentoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedocumentoAPIRequest $request)
    {
        $input = $request->all();

        $documentos = $this->documentoRepository->create($input);

        return $this->sendResponse($documentos->toArray(), 'Documento saved successfully');
    }

    /**
     * Display the specified documento.
     * GET|HEAD /documentos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var documento $documento */
        $documento = $this->documentoRepository->findWithoutFail($id);

        if (empty($documento)) {
            return $this->sendError('Documento not found');
        }

        return $this->sendResponse($documento->toArray(), 'Documento retrieved successfully');
    }

    /**
     * Update the specified documento in storage.
     * PUT/PATCH /documentos/{id}
     *
     * @param  int $id
     * @param UpdatedocumentoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedocumentoAPIRequest $request)
    {
        $input = $request->all();

        /** @var documento $documento */
        $documento = $this->documentoRepository->findWithoutFail($id);

        if (empty($documento)) {
            return $this->sendError('Documento not found');
        }

        $documento = $this->documentoRepository->update($input, $id);

        return $this->sendResponse($documento->toArray(), 'documento updated successfully');
    }

    /**
     * Remove the specified documento from storage.
     * DELETE /documentos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var documento $documento */
        $documento = $this->documentoRepository->findWithoutFail($id);

        if (empty($documento)) {
            return $this->sendError('Documento not found');
        }

        $documento->delete();

        return $this->sendResponse($id, 'Documento deleted successfully');
    }
}
