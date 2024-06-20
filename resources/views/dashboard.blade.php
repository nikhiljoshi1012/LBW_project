@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Create New Project</a>
        <h2>Your Projects</h2>
        <ul>
            @foreach ($projects as $project)
                <li>
                    <a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a>
                    <span>{{ $project->created_at }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
