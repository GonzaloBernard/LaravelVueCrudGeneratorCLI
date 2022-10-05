<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storeentity_nameRequest;
use App\Http\Requests\Updateentity_nameRequest;
use App\Http\Resources\Admin\entity_nameResource;
use App\Models\entity_name;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class entity_nameApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new entity_nameResource(entity_name::all());
    }

    public function store(Storeentity_nameRequest $request)
    {
        $name_camelcase = entity_name::create($request->validated());

        return (new entity_nameResource($name_camelcase))
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

    public function show(entity_name $name_camelcase)
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new entity_nameResource($name_camelcase);
    }

    public function update(Updateentity_nameRequest $request, entity_name $name_camelcase)
    {
        $name_camelcase->update($request->validated());

        return (new entity_nameResource($name_camelcase))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(entity_name $name_camelcase)
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new entity_nameResource($name_camelcase),
            'meta' => [

            ],
        ]);
    }

    public function destroy(entity_name $name_camelcase)
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $name_camelcase->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
