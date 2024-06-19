<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Display Saved Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://webfonts.omenad.net/fonts.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <!-- Flash Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Your form and other content here -->
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="userInput mb-4 p-4">
                <div class="mb-3">
                    <label class="form-label">Project Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ $project->name }}">
                </div>
                <div class="mb-3">
                    <p>Created at: <b> {{ $project->created_at }} </b></p>
                    <p>Updated at: <b> {{ $project->updated_at }} </b></p>
                    <div id="json-string-container"></div>
                </div>
                <button id="load-table-button" class="btn btn-primary mb-3" type="button">Load Table</button>
            </div>
            <div id="table-container"></div>
            <div class="d-flex justify-content-center mt-3">
                <button id="add-rows-button" class="btn btn-secondary mx-2" onclick="addRows()" type="button">Add More
                    Rows</button>
                <input type="submit" id="update-button" class="btn btn-success mx-2" value="Update">
            </div>
            <!-- Add a hidden input field to store project data -->
            <input type="hidden" name="project_data" id="project-data-input">
            <div id="string-output"></div>
        </form>
    </div>
    <div class="keyboard-container">
        <div class="preview-input mb-3">
            <code>
                <input type="text" id="preview-inputbox" value="" onmouseup="getSelectedText()"
                    class="form-control" />
            </code>
            <div class="keyboard">
                <div class="keylayout" id="keylayout">
                    <!-- Keyboard keys will go here -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/script2.js') }}"></script>
    <script>
        const projectData = @json($project->data);
        const projectId = "{{ $project->id }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
</body>

</html>
