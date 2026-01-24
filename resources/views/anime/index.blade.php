@extends('layouts.app')

@section('content')
<h1>Top Anime</h1>

<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:16px;">
@foreach ($animes as $anime)
    <div>
        <img src="{{ $anime['images']['jpg']['image_url'] }}" width="150">
        <p>{{ $anime['title'] }}</p>
        <small>⭐ {{ $anime['score'] ?? '-' }}</small>
    </div>
@endforeach
</div>
@endsection
