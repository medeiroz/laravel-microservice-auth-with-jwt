<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePermissionRequest;
use App\Models\Auth\Role;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RolesPermissionsController extends Controller
{

    public function index(Role $role, Request $request): JsonResponse
    {
        try {
            $resources = $role->perms()->treat($request);
            return response()->json($resources);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function sync(Role $role, RolePermissionRequest $request): JsonResponse
    {
        try {

            $role->savePermissions($request->permissions ?? []);
            return response()->json($role->perms, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
