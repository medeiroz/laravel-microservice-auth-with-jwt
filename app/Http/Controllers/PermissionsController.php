<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Auth\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        try {
            $resources = Permission::treat($request);
            return response()->json($resources);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function store(PermissionRequest $request): JsonResponse
    {
        try {
            $resource = Permission::create($request->all());
            return response()->json($resource, Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function show(Permission $permission): JsonResponse
    {
        try {
            return response()->json($permission, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function update(PermissionRequest $request, Permission $permission): JsonResponse
    {
        try {
            $permission->update($request->all());
            return response()->json($permission, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function destroy(Permission $permission): JsonResponse
    {
        try {
            $permission->delete();
            return response()->json($permission, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
