<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Community;
use App\Models\CommunityMember;

class CommunityController extends Controller
{
    /**
     * Get all communities
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        $type = $request->get('type');

        $communities = Community::active()
            ->with('moderator')
            ->when($type, function ($query) use ($type) {
                return $query->byType($type);
            })
            ->orderBy('name')
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $communities
        ]);
    }

    /**
     * Get a specific community
     */
    public function show(Request $request, $id)
    {
        $community = Community::active()
            ->with('moderator')
            ->findOrFail($id);

        // Check if user is member
        $isMember = false;
        if ($request->user()) {
            $isMember = CommunityMember::where('community_id', $community->id)
                ->where('user_id', $request->user()->id)
                ->where('is_active', true)
                ->exists();
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'community' => $community,
                'is_member' => $isMember
            ]
        ]);
    }

    /**
     * Create a new community
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:public,private,restricted',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $community = new Community([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'description' => $request->description,
            'type' => $request->type,
            'moderator_id' => $user->id,
            'is_active' => true,
        ]);

        $community->save();

        // Add creator as member
        $member = new CommunityMember([
            'community_id' => $community->id,
            'user_id' => $user->id,
            'role' => 'moderator',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        $member->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Community created successfully',
            'data' => $community->load('moderator')
        ], 201);
    }
}