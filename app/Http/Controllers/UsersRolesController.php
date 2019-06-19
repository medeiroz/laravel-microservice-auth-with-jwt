<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRoleRequest;
use App\Models\Auth\User;
use App\Models\Auth\Role;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UsersRolesController extends Controller
{

    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;

        $this->middleware('permission:users.read');
        $this->middleware('permission:users.store')->only('store');
        $this->middleware('permission:users.update')->only('update');
        $this->middleware('permission:users.destroy')->only('destroy');
    }

    public function index(User $user, Request $request): JsonResponse
    {
        $resources = $user->roles()->treat($request);
        return response()->json($resources);
    }

    public function sync(User $user, UserRoleRequest $request): JsonResponse
    {
        dd($request->roles);

        $resource = $user->roles()->sync($request->roles);
        return response()->json($resource, 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user, 200);
    }

}
