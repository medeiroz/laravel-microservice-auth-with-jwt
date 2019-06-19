<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->middleware('permission:users.read');
        $this->middleware('permission:users.store')->only('store');
        $this->middleware('permission:users.update')->only('update');
        $this->middleware('permission:users.destroy')->only('destroy');
    }


    public function index(Request $request): JsonResponse
    {
        $resources = User::treat($request);
        return response()->json($resources);
    }


    public function store(UserRequest $request): JsonResponse
    {
        $resource = User::create($request->all());
        return response()->json($resource, 201);
    }


    public function show(User $user): JsonResponse
    {
        return response()->json($user, 200);
    }


    public function update(UserRequest $request, User $user): JsonResponse
    {
        $user->update($request->all());
        return response()->json($user, 201);
    }


    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(['message' => 'Register deleted successfully'], 201);
    }
}
