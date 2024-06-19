<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Display Saved Data</title>
    <link rel="stylesheet" href="https://webfonts.omenad.net/fonts.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/raag_taal.css') }}">
</head>

<body>
    <h1>{{ $project->name }}</h1>
    <p>Created at: {{ $project->created_at }}</p>
    <p>Updated at: {{ $project->updated_at }}</p>
    <div id="json-string-container"></div>
    <button id="load-table-button">Load Table</button>
    <div class="container" >
    <form action="{{ route('projects.store') }}" method="POST">
            @csrf <!-- CSRF Token -->
            <label for="project-name">Project Name:</label>
            <input type="text" id="project-name" name="name" value="{{ $project->name ?? 'Untitled ' . now() }}" />
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

    <script>
        let canAddRows = true;
        var activeCell = null;
        var shiftKey = 0;
        document.addEventListener("DOMContentLoaded", function() {
            const jsonString = @json($project->data);
            const savedData = jsonString;

            // Display the JSON string on top of the page
            document.getElementById(
                "json-string-container"
            ).textContent = `Saved Data: ${JSON.stringify(savedData, null, 2)}`;

            document
                .getElementById("load-table-button")
                .addEventListener("click", generateTableFromSavedData);

                function generateTableFromSavedData() {
                    const { rowCount, columnCount, cells } = savedData;
                    const tableContainer = document.getElementById("table-container");
                    tableContainer.innerHTML = ""; // Clear previous table

                    const table = document.createElement("table");
                    table.className = "table composition bhatkhande-hindi";

                    // Create header row
                    const thead = document.createElement("thead");
                    const headerRow = document.createElement("tr");

                    // Add an empty cell for the top-left corner
                    const emptyHeaderCell = document.createElement("th");
                    emptyHeaderCell.className = "identifier-cell"; // Add class to style
                    headerRow.appendChild(emptyHeaderCell);

                    for (let i = 0; i < columnCount; i++) {
                        const th = document.createElement("th");
                        th.textContent = (i + 1).toString(); // Start numbering from 1
                        th.className = "identifier-cell"; // Add class to style
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
                            td.innerHTML = `<code><input type="text" style="min-width: 150px; border: none; outline: none; font-family: ome_bhatkhande_hindi;" data-cell="${cellKey}" value="${cells[cellKey] || ""}" onfocus="setActiveCell(this)"></code>`;

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

                    // Add event listeners for the inputs
                    const inputs = table.querySelectorAll("input");
                    inputs.forEach((input, index) => {
                        input.addEventListener("keydown", (event) =>
                            handleKeyDown(event, index, columnCount, inputs)
                        );
                        input.addEventListener("focus", () => highlightCell(input));
                        input.addEventListener("blur", () => unhighlightCell(input));
                        input.addEventListener("input", (event) =>
                            captureInput(event, inputs, columnCount)
                        );
                    });

                    // Remove highlight from all cells initially
                    inputs.forEach((input) => input.classList.remove("highlighted"));

                    // Highlight the first cell when it's focused
                    if (inputs.length > 0) {
                        inputs[0].focus(); // Focus the first cell to trigger the highlight
                    }
                }

                // Function to generate row identifiers
                function generateRowIdentifier(index) {
                    let identifier = "";
                    while (index >= 0) {
                        identifier = String.fromCharCode((index % 26) + 65) + identifier;
                        index = Math.floor(index / 26) - 1;
                    }
                    return identifier;
                }

        });

        function setActiveCell(cell) {
            activeCell = cell;
            document.getElementById("preview-inputbox").value = activeCell.value;
        }

        const cellValues = {
            rowCount: 14, // Initial row count
            columnCount: 5, // Default column count
            cells: {}, // Object to store cell positions and their values
        };

        function updateCellValue() {
            activeCell.value = document.getElementById("preview-inputbox").value;
            captureActiveCell();
        }
        
        function addRows() {
            if (!canAddRows) {
                alert("Please wait 5 seconds before adding more rows.");
                return;
            }

            canAddRows = false; // Disable the button
            setTimeout(() => {
                canAddRows = true; // Re-enable the button after 5 seconds
            }, 5000);

            const tbody = document.getElementById("table-body");
            const columnCount = cellValues.columnCount;
            const existingRowCount = tbody.rows.length;

            cellValues.rowCount += 2; // Update row count

            for (let i = 0; i < 2; i++) {
                const tr = document.createElement("tr");

                // Add row identifier cell
                const rowIdentifierCell = document.createElement("td");
                rowIdentifierCell.textContent = generateRowIdentifier(
                    existingRowCount + i
                );
                rowIdentifierCell.className = "identifier-cell"; // Add class to style
                tr.appendChild(rowIdentifierCell);

                for (let j = 0; j < columnCount; j++) {
                    const td = document.createElement("td");
                    td.innerHTML = `<code><input type="text" style="min-width: 150px; border: none; outline: none; font-family: ome_bhatkhande_hindi;" data-cell="${
                        existingRowCount + i
                    }-${j}"></code>`;

                    if ((j + 1) % 4 === 0) {
                        td.classList.add("bold-right-border");
                    }
                    tr.appendChild(td);
                }

                if ((existingRowCount + i) % 2 === 1) {
                    tr.classList.add("bold-bottom-border");
                }
                tbody.appendChild(tr);
            }

            // Add event listeners for the new inputs
            const inputs = tbody.querySelectorAll("input");
            inputs.forEach((input, index) => {
                input.addEventListener("keydown", (event) =>
                    handleKeyDown(event, index, columnCount, inputs)
                );
                input.addEventListener("focus", () => highlightCell(input));
                input.addEventListener("blur", () => unhighlightCell(input));
                input.addEventListener("input", (event) =>
                    captureInput(event, inputs, columnCount)
                );
            });

            // Update the display with the new row count
            updateCellValuesDisplay();
        }

        function handleKeyDown(event, index, columnCount, inputs) {
            let newIndex;

            switch (event.key) {
                case "ArrowRight":
                    newIndex = (index + 1) % inputs.length;
                    break;
                case "ArrowLeft":
                    newIndex = (index - 1 + inputs.length) % inputs.length;
                    break;
                case "ArrowUp":
                    newIndex = (index - columnCount + inputs.length) % inputs.length;
                    break;
                case "ArrowDown":
                    newIndex = (index + columnCount) % inputs.length;
                    break;
                default:
                    return; // Quit when this doesn't handle the key event.
            }

            inputs[newIndex].focus();
            event.preventDefault(); // Prevent default action (scroll / move caret)
        }

        function highlightCell(input) {
            input.classList.add("highlighted");
        }

        function unhighlightCell(input) {
            input.classList.remove("highlighted");
        }

        function captureInput(event, inputs, columnCount) {
            const input = event.target;
            const cell = input.dataset.cell;
            const value = input.value;

            if (value) {
                cellValues.cells[cell] = value;
            } else {
                delete cellValues.cells[cell]; // Remove the key if input is empty
            }
            updateCellValuesDisplay();
        }

        function captureActiveCell() {
            const cell = activeCell.dataset.cell;
            const value = activeCell.value;

            if (value) {
                cellValues.cells[cell] = value;
            } else {
                delete cellValues.cells[cell]; // Remove the key if input is empty
            }
            updateCellValuesDisplay();
        }

        function updateCellValuesDisplay() {
            document.getElementById(
                "string-output"
            ).innerText = `Cell Values: ${JSON.stringify(cellValues)}`;
            console.log(cellValues); // For debugging purposes
        }

        function saveData() {
            // Serialize cellValues object
            console.log("clicked");
            const serializedData = JSON.stringify(cellValues);
            console.log(serializedData);
            // Update the hidden input field with serialized data
            document.getElementById("project-data-input").value = serializedData;
            // Submit the form
            document.querySelector("form").submit();
        }

        
    </script>

    
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
