<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }


        $user->tokens()->delete();

        $token = $user->createToken('evertrack-api')->plainTextToken;


        return response()->json([
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => new UserResource($user),
        ]);
    }
}
