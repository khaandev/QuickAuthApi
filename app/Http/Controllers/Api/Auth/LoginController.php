<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Auth\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request,LoginService $loginService): JsonResponse
    {
      $data = $loginService->login(
        $request->email,
        $request->password

      );

        return response()->json([
            'message' => 'Login successful',
            'token'   => $data['token'],
            'user'    => new UserResource($data['user']),
        ]);
    }
}
