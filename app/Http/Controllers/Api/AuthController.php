<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return $this->success([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'status' => $user->status,
                'email' => $user->email,
                'role' => $user->role,
            ]
        ], 'Login successful');
    }

    public function logout(Request $request): JsonResponse
    {
         $request->user()->currentAccessToken()->delete();
        return $this->success(null, 'Logged out successfully');
    }
}
