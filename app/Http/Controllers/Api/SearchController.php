<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecourse;
use App\Models\Program;
use App\Models\Event;
use App\Models\Podcast;
use App\Models\Post;

class SearchController extends ApiBaseController
{
    /**
     * Search across all content types
     */
    public function index(Request $request)
    {
        try {
            $query = $request->get('q');
            $type = $request->get('type'); // ecourse, program, event, podcast, post, all
            $perPage = $request->get('per_page', 12);

            if (!$query) {
                return $this->success([
                    'query' => $query,
                    'results' => [],
                    'total' => 0,
                ], 'No search query provided');
            }

            $results = [];
            $total = 0;

            // Search e-courses
            if (!$type || $type === 'ecourse' || $type === 'all') {
                $ecourses = Ecourse::active()
                    ->where('title', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->limit(5)
                    ->get();
                    
                foreach ($ecourses as $ecourse) {
                    $results[] = [
                        'type' => 'ecourse',
                        'id' => $ecourse->id,
                        'title' => $ecourse->title,
                        'description' => $ecourse->short_description ?? substr($ecourse->description, 0, 150),
                        'image' => $ecourse->thumbnail,
                        'created_at' => $ecourse->created_at,
                    ];
                }
                
                $total += $ecourses->count();
            }

            // Search programs
            if (!$type || $type === 'program' || $type === 'all') {
                $programs = Program::active()
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->limit(5)
                    ->get();
                    
                foreach ($programs as $program) {
                    $results[] = [
                        'type' => 'program',
                        'id' => $program->id,
                        'title' => $program->name,
                        'description' => $program->short_description ?? substr($program->description, 0, 150),
                        'image' => $program->image,
                        'created_at' => $program->created_at,
                    ];
                }
                
                $total += $programs->count();
            }

            // Search events
            if (!$type || $type === 'event' || $type === 'all') {
                $events = Event::where('is_active', true)
                    ->where('title', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->limit(5)
                    ->get();
                    
                foreach ($events as $event) {
                    $results[] = [
                        'type' => 'event',
                        'id' => $event->id,
                        'title' => $event->title,
                        'description' => $event->short_description ?? substr($event->description, 0, 150),
                        'image' => $event->image,
                        'created_at' => $event->created_at,
                    ];
                }
                
                $total += $events->count();
            }

            // Search podcasts
            if (!$type || $type === 'podcast' || $type === 'all') {
                $podcasts = Podcast::where('is_active', true)
                    ->where('title', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->limit(5)
                    ->get();
                    
                foreach ($podcasts as $podcast) {
                    $results[] = [
                        'type' => 'podcast',
                        'id' => $podcast->id,
                        'title' => $podcast->title,
                        'description' => $podcast->short_description ?? substr($podcast->description, 0, 150),
                        'image' => $podcast->thumbnail,
                        'created_at' => $podcast->published_at,
                    ];
                }
                
                $total += $podcasts->count();
            }

            // Search posts
            if (!$type || $type === 'post' || $type === 'all') {
                $posts = Post::where('is_active', true)
                    ->where('content', 'like', '%' . $query . '%')
                    ->limit(5)
                    ->get();
                    
                foreach ($posts as $post) {
                    $results[] = [
                        'type' => 'post',
                        'id' => $post->id,
                        'title' => substr($post->content, 0, 50) . '...',
                        'description' => substr($post->content, 0, 150),
                        'image' => $post->image,
                        'created_at' => $post->created_at,
                    ];
                }
                
                $total += $posts->count();
            }

            // Sort results by created_at
            usort($results, function ($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
            });

            return $this->success([
                'query' => $query,
                'results' => $results,
                'total' => $total,
            ], 'Search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve search results', $e->getMessage(), 500);
        }
    }

    /**
     * Search e-courses
     */
    public function ecourses(Request $request)
    {
        try {
            $query = $request->get('q');
            $perPage = $request->get('per_page', 12);

            if (!$query) {
                return $this->success([], 'No search query provided');
            }

            $ecourses = Ecourse::active()
                ->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->paginate($perPage);

            return $this->success($ecourses, 'E-course search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve e-course search results', $e->getMessage(), 500);
        }
    }

    /**
     * Search programs
     */
    public function programs(Request $request)
    {
        try {
            $query = $request->get('q');
            $perPage = $request->get('per_page', 12);

            if (!$query) {
                return $this->success([], 'No search query provided');
            }

            $programs = Program::active()
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->paginate($perPage);

            return $this->success($programs, 'Program search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve program search results', $e->getMessage(), 500);
        }
    }

    /**
     * Search events
     */
    public function events(Request $request)
    {
        try {
            $query = $request->get('q');
            $perPage = $request->get('per_page', 12);

            if (!$query) {
                return $this->success([], 'No search query provided');
            }

            $events = Event::where('is_active', true)
                ->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->paginate($perPage);

            return $this->success($events, 'Event search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve event search results', $e->getMessage(), 500);
        }
    }

    /**
     * Search podcasts
     */
    public function podcasts(Request $request)
    {
        try {
            $query = $request->get('q');
            $perPage = $request->get('per_page', 12);

            if (!$query) {
                return $this->success([], 'No search query provided');
            }

            $podcasts = Podcast::where('is_active', true)
                ->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->paginate($perPage);

            return $this->success($podcasts, 'Podcast search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve podcast search results', $e->getMessage(), 500);
        }
    }

    /**
     * Search posts
     */
    public function posts(Request $request)
    {
        try {
            $query = $request->get('q');
            $perPage = $request->get('per_page', 12);

            if (!$query) {
                return $this->success([], 'No search query provided');
            }

            $posts = Post::where('is_active', true)
                ->where('content', 'like', '%' . $query . '%')
                ->paginate($perPage);

            return $this->success($posts, 'Post search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve post search results', $e->getMessage(), 500);
        }
    }
}