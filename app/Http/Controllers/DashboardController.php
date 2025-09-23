<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Middleware is handled in routes
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil statistik pengguna
        $stats = [
            'ecourses_enrolled' => 5, // Dummy data, nanti bisa diambil dari database
            'events_attended' => 2,   // Dummy data, nanti bisa diambil dari database
            'learning_progress' => 75 // Dummy data, nanti bisa diambil dari database
        ];
        
        // Aktivitas terbaru pengguna
        $recentActivities = [
            [
                'type' => 'login',
                'description' => 'Login ke akun Anda',
                'time' => '2 jam yang lalu'
            ],
            [
                'type' => 'ecourse',
                'description' => 'Mengakses e-course Robotik',
                'time' => '1 hari yang lalu'
            ],
            [
                'type' => 'profile',
                'description' => 'Memperbarui informasi profil',
                'time' => '3 hari yang lalu'
            ]
        ];
        
        // Quick access menu
        $quickAccess = [
            [
                'title' => 'E-Course Robotik',
                'icon' => '🤖',
                'url' => '/ecourse/robotik'
            ],
            [
                'title' => 'Film & Konten Kreator',
                'icon' => '🎬',
                'url' => '/course-film-konten-kreator'
            ],
            [
                'title' => 'Event Mendatang',
                'icon' => '📅',
                'url' => '/event'
            ],
            [
                'title' => 'Profil Saya',
                'icon' => '👤',
                'url' => '/profile'
            ]
        ];
        
        // Recommended content
        $recommendedContent = [
            [
                'title' => 'Workshop Digital Marketing',
                'type' => 'Workshop',
                'description' => 'Pelajari strategi digital marketing terbaru',
                'image' => 'digital-marketing'
            ],
            [
                'title' => 'E-Course UI/UX Design',
                'type' => 'E-Course',
                'description' => 'Master desain antarmuka pengguna modern',
                'image' => 'ui-ux'
            ],
            [
                'title' => 'Kompetisi Robotik Nasional',
                'type' => 'Event',
                'description' => 'Ikuti kompetisi robotik tingkat nasional',
                'image' => 'robotik'
            ]
        ];
        
        return view('dashboard', compact('user', 'stats', 'recentActivities', 'quickAccess', 'recommendedContent'));
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = Auth::user();
        
        return view('profile', compact('user'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = 'avatar_' . $user->id . '_' . time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = $avatar->storeAs('avatars', $avatarName, 'public');
            $data['avatar'] = $avatarPath;
        }

        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui!');
    }
}