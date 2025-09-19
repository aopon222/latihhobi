<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Community;
use Illuminate\Support\Facades\Validator;

class PostController extends ApiBaseController
{
    /**
     * Get all posts
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 12);
            $communityId = $request->get('community_id');
            $search = $request->get('search');

            $posts = Post::where('is_active', true)
                ->when($communityId, function ($query) use ($communityId) {
                    return $query->where('community_id', $communityId);
                })
                ->when($search, function ($query) use ($search) {
                    return $query->where('content', 'like', '%' . $search . '%');
                })
                ->with(['user', 'community'])
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            return $this->success($posts, 'Posts retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve posts', $e->getMessage(), 500);
        }
    }

    /**
     * Get a specific post
     */
    public function show($id)
    {
        try {
            $post = Post::where('is_active', true)
                ->with(['user', 'community'])
                ->findOrFail($id);

            return $this->success($post, 'Post retrieved successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Post not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve post', $e->getMessage(), 500);
        }
    }

    /**
     * Create a new post
     */
    public function store(Request $request)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'community_id' => 'required|exists:communities,id',
                'content' => 'required|string',
                'image' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            $community = Community::where('is_active', true)
                ->findOrFail($request->community_id);
                
            // Check if user is a member of the community
            $membership = $user->communityMemberships()
                ->where('community_id', $community->id)
                ->where('status', 'active')
                ->first();
                
            if (!$membership) {
                return $this->error('You must be a member of this community to post', null, 403);
            }
            
            $post = Post::create([
                'user_id' => $user->id,
                'community_id' => $request->community_id,
                'content' => $request->content,
                'image' => $request->image,
                'is_active' => true,
            ]);

            // Load relationships
            $post->load(['user', 'community']);

            return $this->success($post, 'Post created successfully', 201);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Community not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to create post', $e->getMessage(), 500);
        }
    }

    /**
     * Update a post
     */
    public function update(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'content' => 'required|string',
                'image' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            $post = Post::findOrFail($id);
            
            // Check if user owns the post
            if ($post->user_id !== $user->id) {
                return $this->error('You can only edit your own posts', null, 403);
            }
            
            $post->update([
                'content' => $request->content,
                'image' => $request->image,
            ]);

            // Load relationships
            $post->load(['user', 'community']);

            return $this->success($post, 'Post updated successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Post not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to update post', $e->getMessage(), 500);
        }
    }

    /**
     * Delete a post
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $post = Post::findOrFail($id);
            
            // Check if user owns the post or is community moderator
            $isOwner = $post->user_id === $user->id;
            $isModerator = $post->community->moderator_id === $user->id;
            
            if (!$isOwner && !$isModerator) {
                return $this->error('You can only delete your own posts or posts in communities you moderate', null, 403);
            }
            
            $post->update(['is_active' => false]);

            return $this->success(null, 'Post deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Post not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to delete post', $e->getMessage(), 500);
        }
    }

    /**
     * Like a post
     */
    public function like(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $post = Post::where('is_active', true)
                ->findOrFail($id);
                
            // Check if user has already liked the post
            $existingLike = $post->likes()
                ->where('user_id', $user->id)
                ->first();
                
            if ($existingLike) {
                // Unlike the post
                $existingLike->delete();
                $liked = false;
            } else {
                // Like the post
                $post->likes()->create([
                    'user_id' => $user->id,
                ]);
                $liked = true;
            }
            
            // Get updated like count
            $likeCount = $post->likes()->count();

            return $this->success([
                'liked' => $liked,
                'like_count' => $likeCount
            ], $liked ? 'Post liked successfully' : 'Post unliked successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Post not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to like post', $e->getMessage(), 500);
        }
    }

    /**
     * Get posts by community
     */
    public function byCommunity($communityId)
    {
        try {
            $community = Community::where('is_active', true)
                ->findOrFail($communityId);
                
            $posts = Post::where('community_id', $community->id)
                ->where('is_active', true)
                ->with(['user', 'community'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return $this->success($posts, 'Community posts retrieved successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Community not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve community posts', $e->getMessage(), 500);
        }
    }

    /**
     * Get user's posts
     */
    public function myPosts(Request $request)
    {
        try {
            $user = $request->user();
            
            $posts = Post::where('user_id', $user->id)
                ->where('is_active', true)
                ->with(['user', 'community'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            return $this->success($posts, 'My posts retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve my posts', $e->getMessage(), 500);
        }
    }
}