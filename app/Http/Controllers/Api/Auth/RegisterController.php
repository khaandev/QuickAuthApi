<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create(attributes: [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('evertrack-api')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful',
            'token'   => $token,
            'user'    => new UserResource($user),
        ], 201);
    }
}
