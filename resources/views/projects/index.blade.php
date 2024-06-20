@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Projects</h1>
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Create New Project</a>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->created_at }}</td>
                            <td>
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
