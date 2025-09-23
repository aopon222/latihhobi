<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\CommunityMember;
use Illuminate\Support\Facades\Validator;

class CommunityController extends ApiBaseController
{
    /**
     * Get all communities
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 12);
            $search = $request->get('search');
            $featured = $request->get('featured');

            $communities = Community::where('is_active', true)
                ->when($search, function ($query) use ($search) {
                    return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                })
                ->when($featured, function ($query) use ($featured) {
                    return $query->where('is_featured', $featured);
                })
                ->withCount('members')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            return $this->success($communities, 'Communities retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve communities', $e->getMessage(), 500);
        }
    }

    /**
     * Get a specific community
     */
    public function show($id)
    {
        try {
            $community = Community::where('is_active', true)
                ->withCount('members')
                ->findOrFail($id);

            return $this->success($community, 'Community retrieved successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Community not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve community', $e->getMessage(), 500);
        }
    }

    /**
     * Create a new community
     */
    public function store(Request $request)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|string|max:100',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            // Check if user already moderates a community
            $existingCommunity = $user->communities()->first();
            if ($existingCommunity) {
                return $this->error('You already moderate a community');
            }
            
            $community = Community::create([
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'moderator_id' => $user->id,
                'is_active' => true,
            ]);
            
            // Add user as member
            CommunityMember::create([
                'community_id' => $community->id,
                'user_id' => $user->id,
                'role' => 'moderator',
                'status' => 'active',
                'joined_at' => now(),
            ]);

            return $this->success($community, 'Community created successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to create community', $e->getMessage(), 500);
        }
    }

    /**
     * Join a community
     */
    public function join(Request $request, $communityId)
    {
        try {
            $user = $request->user();
            
            $community = Community::where('is_active', true)
                ->findOrFail($communityId);
                
            // Check if user is already a member
            $existingMembership = $user->communityMemberships()
                ->where('community_id', $community->id)
                ->first();
                
            if ($existingMembership) {
                if ($existingMembership->status === 'active') {
                    return $this->error('You are already a member of this community');
                } else {
                    // Reactivate membership
                    $existingMembership->update([
                        'status' => 'active',
                        'joined_at' => now(),
                    ]);
                    
                    return $this->success($existingMembership, 'Membership reactivated successfully');
                }
            }
            
            // Create new membership
            $membership = CommunityMember::create([
                'community_id' => $community->id,
                'user_id' => $user->id,
                'role' => 'member',
                'status' => 'active',
                'joined_at' => now(),
            ]);

            return $this->success($membership, 'Joined community successfully', 201);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Community not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to join community', $e->getMessage(), 500);
        }
    }

    /**
     * Leave a community
     */
    public function leave(Request $request, $communityId)
    {
        try {
            $user = $request->user();
            
            $community = Community::where('is_active', true)
                ->findOrFail($communityId);
                
            // Check if user is a member
            $membership = $user->communityMemberships()
                ->where('community_id', $community->id)
                ->first();
                
            if (!$membership) {
                return $this->error('You are not a member of this community');
            }
            
            // Check if user is the moderator
            if ($community->moderator_id === $user->id) {
                return $this->error('Moderators cannot leave their own community');
            }
            
            // Deactivate membership
            $membership->update([
                'status' => 'inactive',
                'left_at' => now(),
            ]);

            return $this->success($membership, 'Left community successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Community not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to leave community', $e->getMessage(), 500);
        }
    }

    /**
     * Get community members
     */
    public function members($communityId)
    {
        try {
            $community = Community::where('is_active', true)
                ->findOrFail($communityId);
                
            $members = CommunityMember::where('community_id', $community->id)
                ->where('status', 'active')
                ->with('user')
                ->orderBy('joined_at', 'asc')
                ->paginate(20);

            return $this->success($members, 'Community members retrieved successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Community not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve community members', $e->getMessage(), 500);
        }
    }
}