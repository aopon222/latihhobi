<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;

class EventController extends ApiBaseController
{
    /**
     * Get all events
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 12);
            $type = $request->get('type');
            $featured = $request->get('featured');
            $status = $request->get('status');
            $search = $request->get('search');

            $events = Event::where('is_active', true)
                ->when($type, function ($query) use ($type) {
                    return $query->where('type', $type);
                })
                ->when($featured, function ($query) use ($featured) {
                    return $query->where('is_featured', $featured);
                })
                ->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->when($search, function ($query) use ($search) {
                    return $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                })
                ->orderBy('start_date', 'asc')
                ->paginate($perPage);

            return $this->success($events, 'Events retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve events', $e->getMessage(), 500);
        }
    }

    /**
     * Get a specific event
     */
    public function show($id)
    {
        try {
            $event = Event::where('is_active', true)
                ->findOrFail($id);

            return $this->success($event, 'Event retrieved successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Event not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve event', $e->getMessage(), 500);
        }
    }

    /**
     * Get featured events
     */
    public function featured()
    {
        try {
            $events = Event::where('is_active', true)
                ->where('is_featured', true)
                ->where('status', 'open')
                ->orderBy('start_date', 'asc')
                ->limit(6)
                ->get();

            return $this->success($events, 'Featured events retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve featured events', $e->getMessage(), 500);
        }
    }

    /**
     * Get upcoming events
     */
    public function upcoming()
    {
        try {
            $events = Event::where('is_active', true)
                ->where('status', 'open')
                ->where('start_date', '>', now())
                ->orderBy('start_date', 'asc')
                ->limit(10)
                ->get();

            return $this->success($events, 'Upcoming events retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve upcoming events', $e->getMessage(), 500);
        }
    }

    /**
     * Search events
     */
    public function search(Request $request)
    {
        try {
            $search = $request->get('q');

            if (!$search) {
                return $this->success([], 'No search term provided');
            }

            $events = Event::where('is_active', true)
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orderBy('start_date', 'asc')
                ->paginate(12);

            return $this->success($events, 'Search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to search events', $e->getMessage(), 500);
        }
    }

    /**
     * Register for an event
     */
    public function register(Request $request, $eventId)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'parent_name' => 'required|string|max:255',
                'parent_phone' => 'required|string|max:20',
                'child_name' => 'required|string|max:255',
                'child_age' => 'required|integer|min:5|max:18',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            $event = Event::where('is_active', true)
                ->where('status', 'open')
                ->findOrFail($eventId);
                
            // Check if registration is still open
            if ($event->registration_end && now() > $event->registration_end) {
                return $this->error('Registration for this event has closed');
            }
            
            // Check if event is full
            if ($event->max_participants > 0 && $event->current_participants >= $event->max_participants) {
                return $this->error('This event is already full');
            }
            
            // Check if user is already registered
            $existingRegistration = $user->eventRegistrations()
                ->where('event_id', $event->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->first();
                
            if ($existingRegistration) {
                return $this->error('You are already registered for this event');
            }
            
            // Create registration
            $registration = $user->eventRegistrations()->create([
                'event_id' => $event->id,
                'parent_name' => $request->parent_name,
                'parent_phone' => $request->parent_phone,
                'child_name' => $request->child_name,
                'child_age' => $request->child_age,
                'status' => 'pending',
                'registered_at' => now(),
            ]);
            
            // Increment participant count
            $event->increment('current_participants');

            return $this->success($registration, 'Event registration created successfully', 201);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Event not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to register for event', $e->getMessage(), 500);
        }
    }
}