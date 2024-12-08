@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Manage Posts</a>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Manage Users</a>
    </div>
@endsection
