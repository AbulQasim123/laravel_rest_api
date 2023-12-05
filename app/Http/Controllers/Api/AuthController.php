<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Services\UserApiResponse;

class AuthController extends Controller
{
    // Register
    public function userRegister(UserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->userName,
                'email' => $request->userEmail,
                'profession' => $request->userProfession,
                'password' => Hash::make($request->userPassword),
            ]);
            return response()->json(UserApiResponse::success($user, 'Registration successful'), 200);
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }

    // Login
    public function userLogin(UserRequest $request)
    {
        try {
            $user = User::where('email', $request->userEmail)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken('auth-token')->plainTextToken;
                    return response()->json(UserApiResponse::success($user, 'Login successful', $token), 200);
                } else {
                    return response()->json(UserApiResponse::error('Incorrect credentials'), 400);
                }
            } else {
                return response()->json(UserApiResponse::error('Incorrect credentials'), 400);
            }
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }

    // Profile
    public function userProfile(Request $request)
    {
        try {
            return response()->json(UserApiResponse::success(new UserResource($request->user()), 'User successfully fetched'), 200);
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }

    // Logout
    public function userLogout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(UserApiResponse::success(null, 'Logout successful'), 200);
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }
}
