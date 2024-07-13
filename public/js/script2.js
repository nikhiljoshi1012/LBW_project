document.addEventListener("DOMContentLoaded", function () {
    var savedData = projectData;
    console.log("Saved Data:", savedData);

    document.getElementById("resizeRow").value = savedData.rowCount / 2;
    document.getElementById("resizeCol").value = savedData.columnCount;

    document.getElementById(
        "json-string-container"
    ).textContent = `Saved Data: ${JSON.stringify(savedData, null, 2)}`;

    document
        .getElementById("load-table-button")
        .addEventListener("click", generateTableFromSavedData);

    function generateTableFromSavedData() {
        const { rowCount, columnCount, cells } = savedData;
        const spreadSheetContainer = document.getElementById("table-container");
        spreadSheetContainer.style.display = "block";
        const tableContainer = document.createElement("div");
        tableContainer.style.display = "block";
        tableContainer.innerHTML = ""; // Clear previous table
        tableContainer.className = "table-sheet";

        const table = document.createElement("table");
        table.className = "table composition bhatkhande-hindi";

        // Create header row
        const thead = document.createElement("thead");
        const headerRow = document.createElement("tr");
        headerRow.classList.add("header-row");
        headerRow.classList.add("bold-bottom-border");
        const th = document.createElement("th");
        th.textContent = "#";
        headerRow.appendChild(th);
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
                const fontFamily =
                    i % 2 === 0
                        ? "ome_bhatkhande_hindi"
                        : "Noto Sans Devanagari";
                const classItem =
                    i % 2 === 0 ? "bhatkhande-hindi" : "devnagari";
                td.innerHTML = `<code><input type="text" class="table-cell ${classItem}" style="min-width: 150px; border: none; outline: none; font-family: ${fontFamily};" data-cell="${cellKey}" maxlength="4" value="${
                    cells[cellKey] || ""
                }" onfocus="setActiveCell(this)"></code>`;

                // if ((j + 1) % 4 === 0) {
                //     td.classList.add("bold-right-border");
                // }
                tr.appendChild(td);
            }

            if (i % 2 === 1) {
                tr.classList.add("bold-bottom-border");
            }

            if (i % 2 === 0 && i !== 0) {
                tbody.appendChild(document.createElement("br"));
                tr.classList.add("bold-top-border");
            }
            tbody.appendChild(tr);
        }
        tbody.appendChild(document.createElement("br"));

        table.appendChild(tbody);
        tableContainer.appendChild(table);

        document.getElementById("update-button").style.display = "inline";
        document.getElementsByClassName("keyboard-container")[0].style.display =
            "flex";
        // Add event listeners for the new inputs
        const inputs = tbody.querySelectorAll("input");
        inputs.forEach((input, index) => {
            input.addEventListener("keydown", (event) =>
                handleKeyDown(event, index, columnCount, inputs)
            );

            input.addEventListener("input", (event) =>
                captureInput(event, inputs, columnCount)
            );
        });

        // Update the display with the new row count
        updateCellValuesDisplay();
        spreadSheetContainer.appendChild(tableContainer);

        const rowButton = document.createElement("div");
        rowButton.className = "d-flex justify-content-center mt-3";
        spreadSheetContainer.appendChild(rowButton);
        rowButton.innerHTML =
            '<button id="add-rows-button" class="btn btn-secondary btn-block mb-3" onclick="addRows()" type="button">Add More Rows</button>';
        document.getElementById("add-rows-button").style.display = "inline";
    }

    function generateRowIdentifier(index) {
        let identifier = "";
        while (index >= 0) {
            identifier = String.fromCharCode((index % 26) + 65) + identifier;
            index = Math.floor(index / 26) - 1;
        }
        return identifier;
    }

    function extractTableData() {
        const table = document.querySelector("#table-container table");
        const cells = {};
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach((row, rowIndex) => {
            const inputs = row.querySelectorAll("input[data-cell]");
            inputs.forEach((input) => {
                const cellKey = input.getAttribute("data-cell");
                cells[cellKey] = input.value;
            });
        });
        return {
            rowCount: rows.length,
            columnCount: rows[0].querySelectorAll("td").length - 1, // Exclude the row identifier column
            cells: cells,
        };
    }

    //! Update function
    document
        .getElementById("update-button")
        .addEventListener("click", function (event) {
            event.preventDefault();

            const tableData = extractTableData();
            const projectDataInput =
                document.getElementById("project-data-input");
            projectDataInput.value = JSON.stringify(tableData);

            const projectName =
                document.querySelector('input[name="name"]').value;
            const url = `/projects/${projectId}`; // Update the URL if necessary

            fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({
                    name: projectName,
                    project_data: projectDataInput.value,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        window.location.href = `/projects/${projectId}`;
                    } else {
                        console.error("Update failed:", data);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });

    document
        .getElementById("save-option")
        .addEventListener("click", function (event) {
            event.preventDefault();

            const tableData = extractTableData();
            const projectDataInput =
                document.getElementById("project-data-input");
            projectDataInput.value = JSON.stringify(tableData);

            const projectName =
                document.querySelector('input[name="name"]').value;
            const url = `/projects/${projectId}`; // Update the URL if necessary

            fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({
                    name: projectName,
                    project_data: projectDataInput.value,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        window.location.href = `/projects/${projectId}`;
                    } else {
                        console.error("Update failed:", data);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });

    document
        .getElementById("backButton")
        .addEventListener("click", function (event) {
            event.preventDefault();

            const tableData = extractTableData();
            const projectDataInput =
                document.getElementById("project-data-input");
            projectDataInput.value = JSON.stringify(tableData);

            const projectName =
                document.querySelector('input[name="name"]').value;
            const url = `/projects/${projectId}`; // Update the URL if necessary

            fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({
                    name: projectName,
                    project_data: projectDataInput.value,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        window.location.href = `/dashboard`;
                    } else {
                        console.error("Update failed:", data);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });

    document
        .getElementById("copyProjectButton")
        .addEventListener("click", function () {
            // const csrfToken = document.querySelector('input[name="_token"]').value; // Get CSRF token from hidden input

            fetch(`/projects/${projectId}/copy`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log(data); // Handle success
                    window.location.href = data.redirect;
                    // alert("Project copied successfully!");
                    // Optionally, redirect or update the UI here
                })
                .catch((error) => {
                    console.error(
                        "There has been a problem with your fetch operation:",
                        error
                    );
                });
        });

    // Function to add more rows
    // function addRows() {
    //     const tableBody = document.getElementById("table-body");
    //     const currentRowCount = tableBody.rows.length;
    //     const currentColumnCount = tableBody.rows[0].cells.length - 1; // Exclude the row identifier column

    //     const newRow = document.createElement("tr");

    //     // Add row identifier cell
    //     const rowIdentifierCell = document.createElement("td");
    //     rowIdentifierCell.textContent = generateRowIdentifier(currentRowCount);
    //     rowIdentifierCell.className = "identifier-cell"; // Add class to style
    //     newRow.appendChild(rowIdentifierCell);

    //     for (let j = 0; j < currentColumnCount; j++) {
    //         const newCell = document.createElement("td");
    //         const cellKey = `${currentRowCount}-${j}`;
    //         newCell.innerHTML = `<code><input type="text" style="min-width: 150px; border: none; outline: none; font-family: ome_bhatkhande_hindi;" data-cell="${cellKey}" maxlength="4" value=""></code>`;

    //         if ((j + 1) % 4 === 0) {
    //             newCell.classList.add("bold-right-border");
    //         }
    //         newRow.appendChild(newCell);
    //     }

    //     if (currentRowCount % 2 === 1) {
    //         newRow.classList.add("bold-bottom-border");
    //     }
    //     tableBody.appendChild(newRow);
    // }

    // document
    //     .getElementById("add-rows-button")
    //     .addEventListener("click", addRows);
    var lastSavedData = savedData;
    generateTableFromSavedData();
    function autoSave() {
        const tableData = extractTableData();

        if (tableData === lastSavedData) {
            console.log("No changes to save");
            return;
        }
        lastSavedData = tableData;
        const projectDataInput = document.getElementById("project-data-input");
        projectDataInput.value = JSON.stringify(tableData);

        const projectName = document.querySelector('input[name="name"]').value;
        // Update the URL if necessary

        fetch(url, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                name: projectName,
                project_data: projectDataInput.value,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    console.log("Update successful:", data);
                    //window.location.href = `/projects/${projectId}`;
                } else {
                    console.error("Update failed:", data);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
    setInterval(autoSave, 300000);
});
