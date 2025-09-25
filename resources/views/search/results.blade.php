@extends('layout.app')

@section('title', 'Search Results for "' . $query . '"')

@section('content')
    @include('layout.navbar')

    <div class="container" style="margin-top: 100px;">
        <h1>Search Results for "{{ $query }}"</h1>

        <div class="search-results">
            @if($podcasts->count() > 0)
                <h2>Podcasts</h2>
                <ul>
                    @foreach($podcasts as $podcast)
                        <li>
                            <a href="{{ route('podcasts.show', $podcast) }}">{{ $podcast->title }}</a>
                            <p>{{ Str::limit($podcast->description, 150) }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if($podcasts->count() == 0)
                <p>No results found.</p>
            @endif
        </div>
    </div>
@endsection
