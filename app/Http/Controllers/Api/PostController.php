<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Community;

class PostController extends Controller
{
    /**
     * Get all posts
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        $communityId = $request->get('community_id');
        $type = $request->get('type');

        $posts = Post::published()
            ->with(['user', 'community'])
            ->when($communityId, function ($query) use ($communityId) {
                return $query->byCommunity($communityId);
            })
            ->when($type, function ($query) use ($type) {
                return $query->byType($type);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $posts
        ]);
    }

    /**
     * Get a specific post
     */
    public function show($id)
    {
        $post = Post::published()
            ->with(['user', 'community'])
            ->findOrFail($id);

        // Increment views
        $post->increment('views_count');

        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);
    }

    /**
     * Get posts by community
     */
    public function byCommunity($communityId)
    {
        $community = Community::active()->findOrFail($communityId);

        $posts = Post::published()
            ->byCommunity($communityId)
            ->with(['user', 'community'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return response()->json([
            'status' => 'success',
            'data' => [
                'community' => $community,
                'posts' => $posts
            ]
        ]);
    }

    /**
     * Create a new post
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'community_id' => 'required|exists:communities,id',
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:showcase,discussion,announcement,question,achievement',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if community exists and is active
        $community = Community::active()->findOrFail($request->community_id);

        $post = new Post([
            'user_id' => $user->id,
            'community_id' => $community->id,
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $post->save();

        // Update community post count
        $community->increment('post_count');

        return response()->json([
            'status' => 'success',
            'message' => 'Post created successfully',
            'data' => $post->load(['user', 'community'])
        ], 201);
    }

    /**
     * Like a post
     */
    public function like(Request $request, $id)
    {
        $user = $request->user();

        $post = Post::published()->findOrFail($id);

        // For simplicity, we'll just increment the likes count
        // In a real application, you might want to track who liked what
        $post->increment('likes_count');

        return response()->json([
            'status' => 'success',
            'message' => 'Post liked successfully',
            'data' => [
                'likes_count' => $post->likes_count
            ]
        ]);
    }
}