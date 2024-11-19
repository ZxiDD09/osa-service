<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Email or password is incorrect',
            ], 401);
        }

        $user = auth()->user();

        $user->load([
            'staff.information',
            'student.candidate.information',
        ]);

        return JsonResource::make($user)->additional([
            'access_token' => $user->createToken('authToken')->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => now()->addDays(1)->toDateTimeString(),
            'message' => 'Successfully logged in',
        ]);
    }

    public function check()
    {
        $user = auth()->user();

        $user->load([
            'staff.information',
            'student.candidate.information',
        ]);

        return JsonResource::make($user)->additional([
            'message' => 'Token is still valid',
        ]);
    }

    public function logout()
    {
        auth()->user()->token()->revoke();

        return JsonResource::make(['message' => 'Successfully logged out']);
    }
}
