@extends('layouts.app')
@section('title', 'Sign In or Create Account — Pearl Trails')

@section('content')
    @include('auth.auth-card', ['defaultMode' => 'login'])
@endsection
