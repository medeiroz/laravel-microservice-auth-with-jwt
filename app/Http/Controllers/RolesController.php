<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Auth\Role;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:roles.read');
    }


    public function index(Request $request): JsonResponse
    {
        try {
            $resources = Role::treat($request);
            return response()->json($resources, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function store(RoleRequest $request): JsonResponse
    {
        $this->middleware('permission:roles.store');

        try {
            $resource = Role::create($request->all());
            return response()->json($resource, Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function show(Role $resource): JsonResponse
    {
        try {
            return response()->json($resource, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function update(RoleRequest $request, Role $resource): JsonResponse
    {
        $this->middleware('permission:roles.update');

        try {
            $resource->update($request->all());
            return response()->json($resource, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function destroy(Role $resource): JsonResponse
    {
        $this->middleware('permission:roles.destroy');

        $resource->delete();
        return response()->json($resource, Response::HTTP_OK);
    }
}
