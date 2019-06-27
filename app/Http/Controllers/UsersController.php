<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users.read');
    }


    public function index(Request $request): JsonResponse
    {
        try {
            $resources = User::treat($request);
            return response()->json($resources, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function store(UserRequest $request): JsonResponse
    {
        $this->middleware('permission:users.store');

        try {
            $resource = User::create($request->all());
            return response()->json($resource, Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function show(User $resource): JsonResponse
    {
        return response()->json($resource, Response::HTTP_OK);
    }


    public function update(UserRequest $request, User $resource): JsonResponse
    {
        $this->middleware('permission:users.update');

        try {
            $resource->fill($request->all())->save();
            return response()->json($resource, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function destroy(User $resource): JsonResponse
    {
        $this->middleware('permission:users.destroy');

        try {
            $resource->delete();
            return response()->json($resource, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
