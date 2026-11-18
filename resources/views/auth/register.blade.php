@extends('layouts.app')
@section('title', 'Create an Account or Sign In — Pearl Trails')

@section('content')
    @include('auth.auth-card', ['defaultMode' => 'register'])
@endsection
