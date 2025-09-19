<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Get user profile
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user,
                'profile' => $profile
            ]
        ]);
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'bio' => 'nullable|string|max:500',
            'occupation' => 'nullable|string|max:100',
            'school' => 'nullable|string|max:100',
            'grade' => 'nullable|string|max:20',
            'parent_name' => 'nullable|string|max:100',
            'parent_phone' => 'nullable|string|max:20',
            'parent_email' => 'nullable|email|max:255',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'special_needs' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update user data
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        $user->save();

        // Update or create profile
        $profileData = $request->only([
            'phone', 'address', 'city', 'province', 'postal_code', 'date_of_birth',
            'gender', 'bio', 'occupation', 'school', 'grade', 'parent_name',
            'parent_phone', 'parent_email', 'emergency_contact_name',
            'emergency_contact_phone', 'special_needs'
        ]);

        $profile = $user->profile;
        if (!$profile) {
            $profile = new Profile(['user_id' => $user->id]);
        }

        $profile->fill($profileData);
        $profile->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => [
                'user' => $user,
                'profile' => $profile
            ]
        ]);
    }

    /**
     * Update user avatar
     */
    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = new Profile(['user_id' => $user->id]);
        }

        // Store the avatar
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $profile->avatar = $avatarPath;
        $profile->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Avatar updated successfully',
            'data' => [
                'avatar_url' => asset('storage/' . $avatarPath)
            ]
        ]);
    }
}