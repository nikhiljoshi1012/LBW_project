@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Recycle Bin</h1>
                <a href="{{ route('projects.index') }}" class="ui-btn">
                    <span>Back to Projects</span>
                </a>
                <div class="container -mt5">
                    <table class="table table-striped mt-3" id="recycleBinTable">
                </div>
                <thead>
                    <tr>
                        <th>Srno</th>
                        <th>Name</th>
                        <th>Date Deleted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->deleted_at }}</td>
                            <td>
                                <form action="{{ route('projects.restore', $project->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-custom">Restore</button>
                                </form>
                                <form action="{{ route('projects.forceDelete', $project->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-custom">Delete Permanently</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#recycleBinTable').DataTable(); // Corrected the selector
    });
</script>
<script src="DataTables/datatables.min.js"></script>
