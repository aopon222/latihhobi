<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $podcasts = Podcast::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        return view('search.results', [
            'query' => $query,
            'podcasts' => $podcasts,
        ]);
    }
}
