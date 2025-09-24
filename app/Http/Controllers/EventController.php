<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of events
     */
    public function index()
    {
        $events = Event::published()
            ->upcoming()
            ->orderBy('start_date')
            ->paginate(12);

        return view('events.index', compact('events'));
    }

    /**
     * Display the specified event
     */
    public function show(Event $event)
    {
        // Get related events
        $relatedEvents = Event::published()
            ->where('id', '!=', $event->id)
            ->limit(3)
            ->get();

        return view('events.show', compact('event', 'relatedEvents'));
    }

    /**
     * Display featured events for homepage
     */
    public function featured()
    {
        $events = Event::published()
            ->featured()
            ->orderBy('start_date')
            ->limit(4)
            ->get();

        return response()->json($events);
    }
}
