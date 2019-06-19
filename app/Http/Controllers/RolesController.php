<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Auth\Role;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RolesController extends Controller
{

    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;

        $this->middleware('permission:roles.read');
        $this->middleware('permission:roles.store')->only('store');
        $this->middleware('permission:roles.update')->only('update');
        $this->middleware('permission:roles.destroy')->only('destroy');
    }


    public function index(Request $request): JsonResponse
    {
        $resources = Role::treat($request);
        return response()->json($resources);
    }


    public function store(RoleRequest $request): JsonResponse
    {
        $resource = Role::create($request->all());
        return response()->json($resource, 201);
    }


    public function show(Role $role): JsonResponse
    {
        return response()->json($role, 200);
    }


    public function update(RoleRequest $request, Role $role): JsonResponse
    {
        $role->update($request->all());
        return response()->json($role, 201);
    }


    public function destroy(Role $role): JsonResponse
    {
        $role->delete();
        return response()->json(['message' => 'Register deleted successfully'], 201);
    }
}
