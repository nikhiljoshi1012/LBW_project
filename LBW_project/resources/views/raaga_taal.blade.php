<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Hindi Music Notation Input</title>
        <link rel="stylesheet" href="https://webfonts.omenad.net/fonts.css" />
        <link rel="stylesheet" href="{{ asset('css/raag_taal.css') }}" />
    </head>
    <body>
        
    <div class="container">
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf <!-- CSRF Token -->
            <label for="project-name">Project Name:</label>
            <input type="text" id="project-name" name="name" />
            <br />
            <label for="column-count">Select number of columns:</label>
            <select id="column-count" name="column_count">
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
            </select>
            <button onclick="generateTable()" type="button">Generate Table</button>
            <div id="table-container"></div>
            <button id="add-rows-button" onclick="addRows()" type="button">Add More Rows</button>
            <div id="string-output"></div>
            <!-- Add a hidden input field to store project data -->
            <input type="hidden" name="project_data" id="project-data-input">

            <input type="submit" id="save-button" value="Save">
        </form>
    </div>
        <script src="{{ asset('js/raag_taal.js') }}"></script>
        <div class="keyboard-container">
            <div class="preview-input">
                <code>
                    <input type="text" id="preview-inputbox" id="preview-inputbox" value="" onmouseup="getSelectedText()"/>
                </code>
                <div class="keyboard">
                    <div class="keylayout" id="keylayout">
                        
                            
                        
                    </div>
                </div>
            
            </div>
            
        </div>
    </body>
</html>