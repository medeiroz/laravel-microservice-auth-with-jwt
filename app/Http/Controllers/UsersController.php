<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->middleware('role:admin');
    }


    public function index(Request $request): JsonResponse
    {
        $resources = User::treat($request);
        return response()->json($resources);
    }


    public function store(UserRequest $request): JsonResponse
    {
        $aux_request = $request->all();

        if ($aux_request['password']) {
            $aux_request['password'] = Hash::make($aux_request['password']);
        }

        $resource = User::create($aux_request);

        return response()->json($resource, 201);
    }


    public function show(User $user): JsonResponse
    {
        return response()->json($user, 200);
    }


    public function update(UserRequest $request, User $user): JsonResponse
    {
        $aux_request = $request->all();

        if (isset($aux_request['password'])) {
            $aux_request['password'] = Hash::make($aux_request['password']);
        }


        $user->update($aux_request);

        return response()->json($user, 201);
    }


    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(['message' => 'Register deleted successfully'], 201);
    }
}
