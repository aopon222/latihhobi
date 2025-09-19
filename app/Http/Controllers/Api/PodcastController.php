<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Podcast;

class PodcastController extends ApiBaseController
{
    /**
     * Display a listing of podcasts
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        
        $podcasts = Podcast::active()
            ->ordered()
            ->paginate($perPage);

        return $this->success($podcasts);
    }

    /**
     * Display the specified podcast
     */
    public function show($id)
    {
        $podcast = Podcast::active()->findOrFail($id);

        // Increment play count
        $podcast->increment('play_count');

        return $this->success($podcast);
    }

    /**
     * Get featured podcasts for homepage
     */
    public function featured()
    {
        $podcasts = Podcast::active()
            ->featured()
            ->ordered()
            ->limit(4)
            ->get();

        return $this->success($podcasts);
    }
}