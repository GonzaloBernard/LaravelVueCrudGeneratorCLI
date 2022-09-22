<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNuevaEntidadRequest;
use App\Http\Requests\UpdateNuevaEntidadRequest;
use App\Http\Resources\Admin\NuevaEntidadResource;
use App\Models\NuevaEntidad;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NuevaEntidadApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NuevaEntidadResource(NuevaEntidad::all());
    }

    public function store(StoreNuevaEntidadRequest $request)
    {
        $nuevaEntidad = NuevaEntidad::create($request->validated());

        return (new NuevaEntidadResource($nuevaEntidad))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [

            ],
        ]);
    }

    public function show(NuevaEntidad $nuevaEntidad)
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NuevaEntidadResource($nuevaEntidad);
    }

    public function update(UpdateNuevaEntidadRequest $request, NuevaEntidad $nuevaEntidad)
    {
        $nuevaEntidad->update($request->validated());

        return (new NuevaEntidadResource($nuevaEntidad))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(NuevaEntidad $nuevaEntidad)
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new NuevaEntidadResource($nuevaEntidad),
            'meta' => [

            ],
        ]);
    }

    public function destroy(NuevaEntidad $nuevaEntidad)
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nuevaEntidad->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
