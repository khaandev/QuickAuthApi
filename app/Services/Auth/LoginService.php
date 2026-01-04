<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public function login(string $email, string $password,){
        $user = User::where('email',$email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }
        $user->tokens()->delete();

        $token = $user->createToken('evertrack-api')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,

        ];

    }
}
