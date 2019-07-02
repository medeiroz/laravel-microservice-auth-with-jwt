<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRoleRequest;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UsersRolesController extends Controller
{

    public function index(User $user, Request $request): JsonResponse
    {
        try {
            $resources = $user->roles()->treat($request);
            return response()->json($resources);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function sync(User $user, UserRoleRequest $request): JsonResponse
    {
        try {
            $user->saveRoles($request->roles ?? []);
            return response()->json($user->roles, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
