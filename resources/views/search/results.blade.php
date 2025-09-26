@extends('layout.app')

@section('title', 'Search Results for "' . $query . '"')

@section('content')
    @include('layout.navbar')

    <div class="container" style="margin-top: 100px;">
        <h1>Search Results for "{{ $query }}"</h1>

        @if($podcasts->count() > 0)
            <div class="results-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:20px;margin-top:24px;">
                @foreach($podcasts as $podcast)
                    <article style="background:#fff;padding:16px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.06);">
                        <h3 style="margin-bottom:8px;"><a href="{{ route('podcasts.show', $podcast) }}" style="color:#111;text-decoration:none;">{{ $podcast->title }}</a></h3>
                        <p style="color:#6b7280;margin-bottom:12px;">{{ Str::limit($podcast->description, 160) }}</p>
                        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
                            <a href="{{ route('podcasts.show', $podcast) }}" style="background:#2563eb;color:#fff;padding:8px 12px;border-radius:6px;text-decoration:none;">View</a>
                            <span style="color:#6b7280;font-size:0.9rem;">{{ $podcast->published_date?->format('d M Y') }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p style="margin-top:24px;color:#6b7280;">No results found.</p>
        @endif
    </div>
@endsection
