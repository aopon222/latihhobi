<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Models\Podcast;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim((string) $request->input('query', ''));

        if ($query === '') {
            // No query — return empty collection (or you could return all)
            $podcasts = collect();
            return view('search.results', [
                'query' => $query,
                'podcasts' => $podcasts,
            ]);
        }

        // Support searching against an alternate DB connection if configured.
        // Set SEARCH_DB_CONNECTION in .env to the connection name defined in config/database.php
        $searchConnection = env('SEARCH_DB_CONNECTION') ?: null;

        // Check table existence on the chosen connection (or default connection if none provided)
        try {
            $tableExists = $searchConnection
                ? Schema::connection($searchConnection)->hasTable('podcasts')
                : Schema::hasTable('podcasts');
        } catch (\Exception $e) {
            // If the configured connection is invalid or inaccessible, treat as missing table.
            Log::warning('SearchController: failed to check podcasts table on connection ' . ($searchConnection ?: 'default') . ' — ' . $e->getMessage());
            $tableExists = false;
        }

        if (! $tableExists) {
            $podcasts = collect();
            return view('search.results', [
                'query' => $query,
                'podcasts' => $podcasts,
            ]);
        }

        // Determine DB driver for JSON handling based on connection used
        try {
            $driver = $searchConnection ? DB::connection($searchConnection)->getDriverName() : DB::connection()->getDriverName();
        } catch (\Exception $e) {
            // If driver can't be detected, fall back to a safe non-mysql behavior
            Log::warning('SearchController: failed to get driver for connection ' . ($searchConnection ?: 'default') . ' — ' . $e->getMessage());
            $driver = 'sqlite';
        }

        try {
            // Use Eloquent on() to target an alternate connection if provided
            $queryBuilder = $searchConnection ? Podcast::on($searchConnection) : Podcast::query();

            $podcasts = $queryBuilder->where(function ($q) use ($query, $driver) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");

                // Match topics stored as JSON array. Only use MySQL JSON_SEARCH when on MySQL.
                if ($driver === 'mysql') {
                    $q->orWhereRaw("JSON_SEARCH(topics, 'one', ?) IS NOT NULL", [$query]);
                } else {
                    // Fallback for SQLite and other DBs: do a LIKE against the topics JSON text
                    $q->orWhere('topics', 'like', "%{$query}%");
                }
            })->get();
        } catch (QueryException $e) {
            // Log the exception for debugging but return an empty result set to avoid a 500 error.
            Log::warning('SearchController: DB query failed for search — ' . $e->getMessage());
            $podcasts = collect();
        }

        return view('search.results', [
            'query' => $query,
            'podcasts' => $podcasts,
        ]);
    }
}
