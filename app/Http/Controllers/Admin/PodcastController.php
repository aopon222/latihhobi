<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Podcast::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('host', 'like', '%' . $request->search . '%')
                  ->orWhere('guest', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Filter by featured
        if ($request->filled('featured')) {
            if ($request->featured === 'yes') {
                $query->where('is_featured', true);
            } elseif ($request->featured === 'no') {
                $query->where('is_featured', false);
            }
        }

        $podcasts = $query->orderBy('sort_order', 'asc')
                         ->orderBy('published_date', 'desc')
                         ->paginate(10);

        $hosts = Podcast::distinct()->pluck('host')->filter();
        
        return view('admin.podcasts.index', compact('podcasts', 'hosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.podcasts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'youtube_url' => 'required|url|regex:/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
            'host' => 'required|string|max:255',
            'guest' => 'nullable|string|max:255',
            'topics' => 'nullable|string',
            'published_date' => 'required|date',
            'duration' => 'nullable|string|max:20',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Extract YouTube ID from URL
        $validated['youtube_id'] = $this->extractYouTubeId($validated['youtube_url']);
        
        // Convert topics string to array
        if ($validated['topics']) {
            $validated['topics'] = array_map('trim', explode(',', $validated['topics']));
        }

        // Set default values
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Podcast::create($validated);

        return redirect()->route('admin.podcasts.index')
            ->with('success', 'Podcast berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Podcast $podcast)
    {
        return view('admin.podcasts.show', compact('podcast'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Podcast $podcast)
    {
        return view('admin.podcasts.edit', compact('podcast'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Podcast $podcast)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'youtube_url' => 'required|url|regex:/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
            'host' => 'required|string|max:255',
            'guest' => 'nullable|string|max:255',
            'topics' => 'nullable|string',
            'published_date' => 'required|date',
            'duration' => 'nullable|string|max:20',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Extract YouTube ID from URL
        $validated['youtube_id'] = $this->extractYouTubeId($validated['youtube_url']);
        
        // Convert topics string to array
        if ($validated['topics']) {
            $validated['topics'] = array_map('trim', explode(',', $validated['topics']));
        } else {
            $validated['topics'] = [];
        }

        // Set default values
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $podcast->update($validated);

        return redirect()->route('admin.podcasts.index')
            ->with('success', 'Podcast berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        $podcast->delete();

        return redirect()->route('admin.podcasts.index')
            ->with('success', 'Podcast berhasil dihapus!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Podcast $podcast)
    {
        $podcast->update(['is_featured' => !$podcast->is_featured]);
        
        return response()->json(['success' => true]);
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Podcast $podcast)
    {
        $podcast->update(['is_active' => !$podcast->is_active]);
        
        return response()->json(['success' => true]);
    }

    /**
     * Extract YouTube ID from URL
     */
    private function extractYouTubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        return $matches[1] ?? '';
    }
}
