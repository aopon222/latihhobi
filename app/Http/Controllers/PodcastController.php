<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    /**
     * Display a listing of podcasts
     */
    public function index()
    {
        $podcasts = Podcast::active()
            ->ordered()
            ->paginate(12);

        return view('podcasts.index', compact('podcasts'));
    }

    /**
     * Display the specified podcast
     */
    public function show(Podcast $podcast)
    {
        // Increment views
        $podcast->increment('views');

        // Get related podcasts
        $relatedPodcasts = Podcast::active()
            ->where('id', '!=', $podcast->id)
            ->where(function($query) use ($podcast) {
                if ($podcast->topics) {
                    foreach ($podcast->topics as $topic) {
                        $query->orWhereJsonContains('topics', $topic);
                    }
                }
            })
            ->limit(4)
            ->get();

        return view('podcasts.show', compact('podcast', 'relatedPodcasts'));
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

        return response()->json($podcasts);
    }
}