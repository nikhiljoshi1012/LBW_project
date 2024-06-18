<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hindi Music Notation Input</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://webfonts.omenad.net/fonts.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>

    <div class="container">
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf <!-- CSRF Token -->
            <div class="userInput mb-4 p-4">
                <div class="mb-3">
                    <label for="project-name" class="form-label">Project Name:</label>
                    <input type="text" id="project-name" name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="column-count" class="form-label">Select number of columns:</label>
                    <select id="column-count" name="column_count" class="form-select">
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                    </select>
                </div>
                <button class="btn btn-primary mb-3" onclick="generateTable()" type="button">Generate Table</button>
            </div>
            <div id="table-container"></div>
            <div class="d-flex justify-content-center mt-3">
                <button id="add-rows-button" class="btn btn-secondary mx-2" onclick="addRows()" type="button">Add More
                    Rows</button>
                <input type="submit" id="save-button" class="btn btn-success mx-2" value="Save">
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
</body>

</html>
