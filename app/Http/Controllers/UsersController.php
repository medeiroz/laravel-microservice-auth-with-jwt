<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\UserRequest;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        try {
            $resources = User::treat($request);
            return response()->json($resources, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function store(UserRequest $request)
    {
        return (new RegisterController)->create($request);
    }


    public function show(User $user): JsonResponse
    {
        return response()->json($user, Response::HTTP_OK);
    }


    public function update(UserRequest $request, User $user): JsonResponse
    {
        try {
            $user->fill($request->all())->save();
            return response()->json($user, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function destroy(User $user): JsonResponse
    {
        try {
            $user->delete();
            return response()->json($user, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
