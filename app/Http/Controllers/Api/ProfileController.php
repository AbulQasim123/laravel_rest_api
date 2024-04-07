<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Services\UserApiResponse;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function changePassword(ProfileRequest $request)
    {
        try {
            $user = $request->user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                return response()->json(UserApiResponse::success('Password successfully updated'), 200);
            } else {
                return response()->json(UserApiResponse::error('Old password does not matched'), 400);
            }
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                'profession' => 'nullable|max:100',
                'profile_photo' => 'nullable|image|mimes:jpg,bmp,png'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validations fails',
                    'errors' => $validator->errors(),
                ], 422);
            }
            $user = $request->user();
            if ($request->hasFile('profile_photo')) {
                if ($user->profile_photo) {
                    $old_path = public_path() . '/uploads/profile_images/' . $user->profile_photo;
                    if (File::exists($old_path)) {
                        File::delete($old_path);
                    }
                }
                $image_name = 'profile-image-' . time() . '.' . $request->profile_photo->extension();
                $request->profile_photo->move(public_path('/uploads/profile_images'), $image_name);
            } else {
                $image_name = $user->profile_photo;
            }
            $user->update([
                'name' => $request->name,
                'profession' => $request->profession,
                'profile_photo' => $image_name
            ]);
            return response()->json(UserApiResponse::success('Profile successfully updated'), 200);
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }
}
