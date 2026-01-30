<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->email !== 'multimedia.latihhobi@gmail.com') {
                return redirect()->route('home')->with('error', 'Akses ditolak. Anda tidak memiliki izin admin.');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('short_description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        if ($request->filled('featured')) {
            if ($request->featured === 'yes') {
                $query->where('is_featured', true);
            } elseif ($request->featured === 'no') {
                $query->where('is_featured', false);
            }
        }

        $events = $query->orderBy('start_date', 'desc')->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        // Manual validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'link' => 'nullable|url',
            'description' => 'nullable|string',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'nullable|date_format:Y-m-d\TH:i|after_or_equal:start_date',
            'registration_start' => 'nullable|date_format:Y-m-d\TH:i',
            'registration_end' => 'nullable|date_format:Y-m-d\TH:i|after_or_equal:registration_start',
            'location' => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        // Generate slug from title
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Event::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Ensure folder exists
            $uploadDir = public_path('images/events');
            if (!File::exists($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true);
            }
            
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($uploadDir, $imageName);
            $validated['image'] = 'events/' . $imageName;
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event "' . $validated['title'] . '" berhasil dibuat dan siap digunakan!');
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        // Manual validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'link' => 'nullable|url',
            'description' => 'nullable|string',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'nullable|date_format:Y-m-d\TH:i|after_or_equal:start_date',
            'registration_start' => 'nullable|date_format:Y-m-d\TH:i',
            'registration_end' => 'nullable|date_format:Y-m-d\TH:i|after_or_equal:registration_start',
            'location' => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        // Generate slug if title changed
        if ($event->title !== $validated['title']) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);

            // Ensure unique slug
            $originalSlug = $validated['slug'];
            $count = 1;
            while (Event::where('slug', $validated['slug'])->where('id', '!=', $event->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle image replacement
        if ($request->hasFile('image')) {
            // Ensure folder exists
            $uploadDir = public_path('images/events');
            if (!File::exists($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true);
            }
            
            // remove old image if present
            if ($event->image && file_exists(public_path('images/' . $event->image))) {
                unlink(public_path('images/' . $event->image));
            }
            
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($uploadDir, $imageName);
            $validated['image'] = 'events/' . $imageName;
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event "' . $event->title . '" berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        $eventTitle = $event->title;
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event "' . $eventTitle . '" berhasil dihapus!');
    }

    public function toggleFeatured(Event $event)
    {
        $event->update(['is_featured' => !$event->is_featured]);
        return response()->json(['success' => true, 'is_featured' => $event->is_featured]);
    }

    public function toggleActive(Event $event)
    {
        $event->update(['is_active' => !$event->is_active]);
        return response()->json(['success' => true, 'is_active' => $event->is_active]);
    }
}
