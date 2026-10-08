@extends('layouts.app')
@section('title', 'Explore by Interest')

@section('content')
<div class="page-hero">
    <h1>Explore by Interest: {{ ucfirst($interest ?? 'wildlife') }}</h1>
    <p>Tailor your adventure by categories like Gorilla Trekking, Birding, Cultural Trails, or Safari Drives.</p>
</div>
<div class="content-card">
    <h2>Interest Category: {{ ucfirst($interest ?? 'wildlife') }}</h2>
    <p>Curated activity lists and travel experiences for <strong>{{ $interest ?? 'wildlife' }}</strong> lovers.</p>
</div>
@endsection
