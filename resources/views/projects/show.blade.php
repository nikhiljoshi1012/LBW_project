<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Display Saved Data</title>
    <link rel="stylesheet" href="https://webfonts.omenad.net/fonts.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>{{ $project->name }}</h1>
    <p>Created at: {{ $project->created_at }}</p>
    <p>Updated at: {{ $project->updated_at }}</p>
    <div id="json-string-container"></div>
    <button id="load-table-button">Load Table</button>
    <div class="container" id="table-container"></div>
    <a href="javascript:void(0);" id="download-pdf">Download PDF</a>
    <iframe id="pdf-download-frame" style="display: none;"></iframe> <!-- Hidden iframe for PDF download -->
    <script>
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
                const {
                    rowCount,
                    columnCount,
                    cells
                } = savedData;
                const tableContainer = document.getElementById("table-container");
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
                    for (let j = 0; j < columnCount; j++) {
                        const td = document.createElement("td");
                        const cellKey = `${i}-${j}`;
                        td.innerHTML = `<code><input type="text" style="min-width: 150px; border: none; outline: none; font-family: ome_bhatkhande_hindi;" data-cell="${cellKey}" maxlength="4" value="${
                            cells[cellKey] || ""
                        }" readonly></code>`;

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

            document.getElementById("download-pdf").addEventListener("click", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'PDF Downloaded Successfully',
                    showConfirmButton: true,
                }).then(() => {
                    document.getElementById('pdf-download-frame').src =
                        "{{ route('download-pdf', ['id' => $project->id]) }}";
                });
            });
        });
    </script>
</body>

</html>
