<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecoveryChangerPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Mail\AccountRecovery;
use App\Mail\AccountVerification;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;


class RegisterController extends Controller
{

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(UserRequest $request): JsonResponse
    {
        try {
            $email = null;

            DB::transaction(function() use ($request, &$email) {
                $user = User::create($request->all());
                $email = $this->sendEmailVerification($user->email);
            });

            return $email;

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function sendEmailVerification(string $email): JsonResponse
    {
        try {
            $user = $this->user->byEmail($email)->first();

            if ($user && $user->hasVerifiedEmail() === false) {
                Mail::send(new AccountVerification($user));
                return response()->json(['message' => 'Access your email to verify your account'], Response::HTTP_CREATED);
            }

            return response()->json(['message' => 'Your account not exist or has already been verified previously'], Response::HTTP_BAD_REQUEST);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function verification(Request $request)
    {
        if ($request->hasValidSignature()) {

            $user = User::byEmail($request->user)->first();

            if ($user && $user->hasVerifiedEmail() === false) {
                $user->markEmailAsVerified();
                return response()->json(['message' => 'Account successfully verified'], Response::HTTP_OK);
            }
        }

        return response()->json(['message' => 'Link expired'], Response::HTTP_BAD_REQUEST);
    }


    public function recovery(string $email)
    {
        if ($user = $this->user->byEmail($email)->first()) {
            return $this->sendEmailRecovery($user);
        }

        return response()->json(['message' => 'Not Found'], Response::HTTP_BAD_REQUEST);
    }


    private function sendEmailRecovery(User $user)
    {
        Mail::send(new AccountRecovery($user));
        return response()->json(['message' => 'Access your email to verify your account'], Response::HTTP_CREATED);
    }


    public function changePassword(RecoveryChangerPasswordRequest $request)
    {
        if ($request->hasValidSignature()) {

            if ($user = User::byEmail($request->user)->first()) {
                $user->password = $request->password;
                $user->save();
                return response()->json(['message' => 'Password changed successfully'], Response::HTTP_OK);
            }
        }

        return response()->json(['message' => 'Link expired'], Response::HTTP_BAD_REQUEST);
    }

}
