<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcourseEnrollment;
use Illuminate\Http\Request;

class EcourseEnrollmentController extends Controller
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

    /**
     * Display a listing of enrollments
     */
    public function index(Request $request)
    {
        $query = EcourseEnrollment::with(['user', 'ecourse']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by lock status
        if ($request->filled('lock_status')) {
            if ($request->lock_status === 'locked') {
                $query->where('is_locked', true);
            } elseif ($request->lock_status === 'unlocked') {
                $query->where('is_locked', false);
            }
        }

        // Search by user name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $enrollments = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * Toggle lock/unlock enrollment
     */
    public function toggleLock($id)
    {
        $enrollment = EcourseEnrollment::findOrFail($id);

        $enrollment->update([
            'is_locked' => !$enrollment->is_locked
        ]);

        $action = $enrollment->is_locked ? 'dikunci' : 'dibuka';

        return redirect()->back()->with('success', "Enrollment berhasil {$action}");
    }

    /**
     * Show enrollment details
     */
    public function show($id)
    {
        $enrollment = EcourseEnrollment::with(['user', 'ecourse'])->findOrFail($id);

        return view('admin.enrollments.show', compact('enrollment'));
    }
}
