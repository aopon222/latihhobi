<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\CommunityMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    /**
     * Display a listing of communities
     */
    public function index()
    {
        $communities = Community::active()
            ->with('moderator')
            ->orderBy('is_featured', 'desc')
            ->orderBy('member_count', 'desc')
            ->paginate(12);

        return view('communities.index', compact('communities'));
    }

    /**
     * Display the specified community
     */
    public function show(Community $community)
    {
        // Check if community is active
        if (!$community->is_active) {
            abort(404);
        }

        // Get related communities
        $relatedCommunities = Community::active()
            ->where('id', '!=', $community->id)
            ->limit(3)
            ->get();

        // Check if user is a member
        $isMember = Auth::check() && $community->hasMember(Auth::id());
        
        // Get member count
        $memberCount = $community->member_count;

        return view('communities.show', compact('community', 'relatedCommunities', 'isMember', 'memberCount'));
    }

    /**
     * Show the form for joining a community
     */
    public function joinForm(Community $community)
    {
        // Check if user is already a member
        if ($community->hasMember(Auth::id())) {
            return redirect()->route('communities.show', $community)->with('info', 'Anda sudah menjadi anggota komunitas ini.');
        }

        return view('communities.join', compact('community'));
    }

    /**
     * Join a community
     */
    public function join(Request $request, Community $community)
    {
        // Validate request
        $request->validate([
            'join_reason' => 'nullable|string|max:500'
        ]);

        // Check if user is already a member
        if ($community->hasMember(Auth::id())) {
            return redirect()->route('communities.show', $community)->with('info', 'Anda sudah menjadi anggota komunitas ini.');
        }

        // Create community member record
        CommunityMember::create([
            'community_id' => $community->id,
            'user_id' => Auth::id(),
            'role' => 'member',
            'status' => 'active',
            'joined_at' => now(),
            'join_reason' => $request->join_reason
        ]);

        // Increment member count
        $community->increment('member_count');

        return redirect()->route('communities.show', $community)->with('success', 'Berhasil bergabung dengan komunitas!');
    }

    /**
     * Leave a community
     */
    public function leave(Community $community)
    {
        // Check if user is a member
        $membership = CommunityMember::where('community_id', $community->id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$membership) {
            return redirect()->route('communities.show', $community)->with('error', 'Anda bukan anggota komunitas ini.');
        }

        // Delete membership
        $membership->delete();

        // Decrement member count
        $community->decrement('member_count');

        return redirect()->route('communities.show', $community)->with('success', 'Berhasil keluar dari komunitas.');
    }

    /**
     * Get featured communities for homepage
     */
    public function featured()
    {
        $communities = Community::active()
            ->featured()
            ->limit(3)
            ->get();

        return response()->json($communities);
    }
}
