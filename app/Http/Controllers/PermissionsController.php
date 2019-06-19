<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Auth\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PermissionsController extends Controller
{

    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;

        $this->middleware('permission:permissions.read');
        $this->middleware('permission:permissions.store')->only('store');
        $this->middleware('permission:permissions.update')->only('update');
        $this->middleware('permission:permissions.destroy')->only('destroy');
    }


    public function index(Request $request): JsonResponse
    {
        $resources = Permission::treat($request);
        return response()->json($resources);
    }


    public function store(PermissionRequest $request): JsonResponse
    {
        $resource = Permission::create($request->all());
        return response()->json($resource, 201);
    }


    public function show(Permission $permission): JsonResponse
    {
        return response()->json($permission, 200);
    }


    public function update(PermissionRequest $request, Permission $permission): JsonResponse
    {
        $permission->update($request->all());
        return response()->json($permission, 201);
    }


    public function destroy(Permission $permission): JsonResponse
    {
        $permission->delete();
        return response()->json(['message' => 'Register deleted successfully'], 201);
    }
}
