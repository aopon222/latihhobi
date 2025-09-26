<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends ApiBaseController
{
    /**
     * Get user profile
     */
    public function show(Request $request)
    {
        try {
            $user = $request->user();
            
            // Load additional profile information if exists
            $user->load('profile');

            return $this->success($user, 'Profile retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve profile', $e->getMessage(), 500);
        }
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'date_of_birth' => 'nullable|date',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            // Update user information
            $user->update($request->only(['name', 'email']));
            
            // Update or create profile
            if ($user->profile) {
                $user->profile->update($request->only(['phone', 'address', 'date_of_birth']));
            } else {
                $user->profile()->create($request->only(['phone', 'address', 'date_of_birth']));
            }
            
            // Load updated profile
            $user->load('profile');

            return $this->success($user, 'Profile updated successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to update profile', $e->getMessage(), 500);
        }
    }

    /**
     * Update user avatar
     */
    public function updateAvatar(Request $request)
    {
        // Avatar API removed: profile photo feature disabled
        return $this->error('Avatar update functionality has been disabled', null, 410);
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            // Check current password
            if (!Hash::check($request->current_password, $user->password)) {
                return $this->error('Current password is incorrect', null, 422);
            }
            
            // Update password
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return $this->success(null, 'Password changed successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to change password', $e->getMessage(), 500);
        }
    }

    /**
     * Get user's enrollments
     */
    public function enrollments(Request $request)
    {
        try {
            $user = $request->user();
            
            $enrollments = $user->ecourseEnrollments()
                ->with('ecourse')
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return $this->success($enrollments, 'Enrollments retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve enrollments', $e->getMessage(), 500);
        }
    }

    /**
     * Get user's community memberships
     */
    public function communities(Request $request)
    {
        try {
            $user = $request->user();
            
            $memberships = $user->communityMemberships()
                ->with('community')
                ->where('status', 'active')
                ->orderBy('joined_at', 'desc')
                ->paginate(12);

            return $this->success($memberships, 'Communities retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve communities', $e->getMessage(), 500);
        }
    }
}