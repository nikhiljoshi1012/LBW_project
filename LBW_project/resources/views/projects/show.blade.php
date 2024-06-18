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
</head>

<body>

    <div class="container">
        {{-- <form action="{{ route('projects.store') }}" method="POST"> --}}
        @csrf <!-- CSRF Token -->
        <div class="userInput mb-4 p-4">
            <div class="mb-3">
                <label class="form-label">Project Name:</label>
                <h1>{{ $project->name }}</h1>
            </div>
            <div class="mb-3">
                <p>Created at: <b> {{ $project->created_at }} </b></p>
                <p>Updated at: <b> {{ $project->updated_at }} </b></p>
                <div id="json-string-container"></div>
            </div>
            <button id="load-table-button" class="btn btn-primary mb-3" type="button">Load
                Table</button>
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
        {{-- </form> --}}
    </div>
    {{-- <div class="keyboard-container">
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
    </div> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{-- <script src="{{ asset('js/script.js') }}"></script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const jsonString = @json($project->data);
            const savedData = jsonString;
            console.log("Saved Data:", savedData);

            document.getElementById("json-string-container").textContent = `Saved Data: ${JSON.stringify(
                savedData,
                null,
                2
            )}`;

            document
                .getElementById("load-table-button")
                .addEventListener("click", generateTableFromSavedData);

            function generateTableFromSavedData() {
                const {
                    rowCount,
                    columnCount,
                    cells
                } = savedData;
                const tableContainer = document.getElementById("table-container");
                tableContainer.style.display = "block";
                tableContainer.innerHTML = ""; // Clear previous table

                const table = document.createElement("table");
                table.className = "table composition bhatkhande-hindi";

                // Create header row
                const thead = document.createElement("thead");
                const headerRow = document.createElement("tr");
                for (let i = 0; i < columnCount; i++) {
                    const th = document.createElement("th");
                    th.textContent = (i + 1).toString(); // Start numbering from 1
                    headerRow.appendChild(th);
                }
                thead.appendChild(headerRow);
                table.appendChild(thead);

                const tbody = document.createElement("tbody");
                tbody.id = "table-body"; // Added this line to easily select tbody later

                for (let i = 0; i < rowCount; i++) {
                    const tr = document.createElement("tr");

                    // Add row identifier cell
                    const rowIdentifierCell = document.createElement("td");
                    rowIdentifierCell.textContent = generateRowIdentifier(i);
                    rowIdentifierCell.className = "identifier-cell"; // Add class to style
                    tr.appendChild(rowIdentifierCell);

                    for (let j = 0; j < columnCount; j++) {
                        const td = document.createElement("td");
                        const cellKey = `${i}-${j}`;
                        td.innerHTML =
                            `<code><input type="text" style="min-width: 150px; border: none; outline: none; font-family: ome_bhatkhande_hindi;" data-cell="${cellKey}" maxlength="4" value="${cells[cellKey] || ""}" readonly></code>`;

                        if ((j + 1) % 4 === 0) {
                            td.classList.add("bold-right-border");
                        }
                        tr.appendChild(td);
                    }

                    if (i % 2 === 1) {
                        tr.classList.add("bold-bottom-border");
                    }
                    tbody.appendChild(tr);
                }

                table.appendChild(tbody);
                tableContainer.appendChild(table);
            }
        });

        function generateRowIdentifier(index) {
            let identifier = "";
            while (index >= 0) {
                identifier = String.fromCharCode((index % 26) + 65) + identifier;
                index = Math.floor(index / 26) - 1;
            }
            return identifier;
        }
    </script>
</body>

</html>
