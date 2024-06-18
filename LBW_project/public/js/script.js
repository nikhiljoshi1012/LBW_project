let canAddRows = true;
var activeCell = null;
var shiftKey = 0;

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission
        saveData(); // Call the saveData function
    });
});

const selectedText = {
    text: "",
    start: 0,
    end: 0,
};
function selectedStringLength(str) {
    const regex = /[UuLl]/g;
    const filteredStr = str.replace(regex, "");
    return filteredStr.length;
}

function appendText(char) {
    const previewInputBox = document.getElementById("preview-inputbox");
    const start = previewInputBox.selectionStart;
    const end = previewInputBox.selectionEnd;
    const text = previewInputBox.value;
    const newText = text.substring(0, start) + char + text.substring(end);
    previewInputBox.value = newText;
    const newCursorPosition = newText.length; // Set cursor position to the end of the string
    previewInputBox.setSelectionRange(newCursorPosition, newCursorPosition);
    previewInputBox.focus();
}

function getSelectedText() {
    const inputElement = document.getElementById("preview-inputbox");
    selectedText.start = inputElement.selectionStart;
    selectedText.end = inputElement.selectionEnd;
    selectedText.text = inputElement.value.substring(
        selectedText.start,
        selectedText.end
    );
    console.log(selectedText.text);
    const buttons = document.querySelectorAll("button");
    if (selectedText.text.length >= 1) {
        buttons.forEach((button) => {
            button.disabled = false;
        });
        if (selectedText.text.length < 2) {
            document.getElementById("chhand-key").disabled = true;
        }
        if (shiftKey == 1 && selectedText.text.length < 4) {
            document.getElementById("SPchhand-key").disabled = true;
        }
    }
    return selectedText;
}
function appendOctave(char) {
    getSelectedText();
    let previewInputBoxValue =
        document.getElementById("preview-inputbox").value;
    let textBefore = previewInputBoxValue.substring(0, selectedText.start);
    let textAfter = previewInputBoxValue.substring(selectedText.end);
    let updateSelectedText = "";

    for (let i = 0; i < selectedText.text.length; i++) {
        if (["u", "U", "l", "L"].includes(selectedText.text[i]) && i !== 0) {
            continue;
        } else if (
            ["u", "U", "l", "L"].includes(selectedText.text[i]) &&
            i === 0
        ) {
            updateSelectedText += selectedText.text[i];
        } else {
            updateSelectedText += selectedText.text[i] + char;
        }
    }
    const newText = textBefore + updateSelectedText + textAfter;
    document.getElementById("preview-inputbox").value = newText;

    const buttons = [
        document.getElementById("l-key"),
        document.getElementById("L-key"),
        document.getElementById("u-key"),
        document.getElementById("U-key"),
        document.getElementById("chhand-key"),
    ];
    buttons.forEach((button) => {
        button.disabled = true;
    });
}
function appendChhand() {
    const chhandList = ["@", "#", "$", "%", "^", "&", "*"];

    getSelectedText();

    let previewInputBoxValue =
        document.getElementById("preview-inputbox").value;
    let textBefore = previewInputBoxValue.substring(0, selectedText.start);
    let textAfter = previewInputBoxValue.substring(selectedText.end);
    let updateSelectedText = "";

    updateSelectedText =
        chhandList[(selectedStringLength(selectedText.text) - 2) % 7] +
        selectedText.text;
    const newText = textBefore + updateSelectedText + textAfter;
    document.getElementById("preview-inputbox").value = newText;
    console.log(updateSelectedText);

    const buttons = [
        document.getElementById("l-key"),
        document.getElementById("L-key"),
        document.getElementById("u-key"),
        document.getElementById("U-key"),
        document.getElementById("chhand-key"),
    ];
    buttons.forEach((button) => {
        button.disabled = true;
    });
}
function appendSPChhand() {
    const chhandList = ["`", "!", "~"];

    getSelectedText();

    let previewInputBoxValue =
        document.getElementById("preview-inputbox").value;
    let textBefore = previewInputBoxValue.substring(0, selectedText.start);
    let textAfter = previewInputBoxValue.substring(selectedText.end);
    let updateSelectedText = "";

    const selectedLength = selectedStringLength(selectedText.text);
    const charIndex = Math.floor((selectedLength - 4) / 2);

    updateSelectedText = chhandList[charIndex] + selectedText.text;
    const newText = textBefore + updateSelectedText + textAfter;
    document.getElementById("preview-inputbox").value = newText;
    console.log(updateSelectedText);

    const buttons = [
        document.getElementById("l-key"),
        document.getElementById("L-key"),
        document.getElementById("u-key"),
        document.getElementById("U-key"),
        document.getElementById("chhand-key"),
    ];
    buttons.forEach((button) => {
        button.disabled = true;
    });
}

const keyboard = {
    0: {
        "SA-key": { text: "s", onclick: "appendText", disabled: false },
        "RE-key": { text: "r", onclick: "appendText", disabled: false },
        "GA-key": { text: "g", onclick: "appendText", disabled: false },
        "MA-key": { text: "m", onclick: "appendText", disabled: false },
        "PA-key": { text: "p", onclick: "appendText", disabled: false },
        "DHA-key": { text: "d", onclick: "appendText", disabled: false },
        "NI-key": { text: "n", onclick: "appendText", disabled: false },
        "l-key": { text: "l", onclick: "appendOctave", disabled: true },
        "L-key": { text: "L", onclick: "appendOctave", disabled: true },
        "khali-key": { text: "-", onclick: "appendText", disabled: false },
        "enter-key": {
            text: "Enter",
            onclick: "updateCellValue",
            disabled: false,
        },
        "SAf-key": { text: "S", onclick: "appendText", disabled: false },
        "REf-key": { text: "R", onclick: "appendText", disabled: false },
        "GAf-key": { text: "G", onclick: "appendText", disabled: false },
        "MAf-key": { text: "M", onclick: "appendText", disabled: false },
        "PAf-key": { text: "P", onclick: "appendText", disabled: false },
        "DHAf-key": { text: "D", onclick: "appendText", disabled: false },
        "NIf-key": { text: "N", onclick: "appendText", disabled: false },
        "u-key": { text: "u", onclick: "appendOctave", disabled: true },
        "U-key": { text: "U", onclick: "appendOctave", disabled: true },
        "chhand-key": { text: "@", onclick: "appendChhand", disabled: true },
        "shift-key": {
            text: "Shift",
            onclick: "toggleShiftKey",
            disabled: false,
        },
    },
    1: {
        "0-key": { text: "0", onclick: "appendText", disabled: false },
        "1-key": { text: "1", onclick: "appendText", disabled: false },
        "2-key": { text: "2", onclick: "appendText", disabled: false },
        "3-key": { text: "3", onclick: "appendText", disabled: false },
        "4-key": { text: "4", onclick: "appendText", disabled: false },
        "5-key": { text: "5", onclick: "appendText", disabled: false },
        "6-key": { text: "6", onclick: "appendText", disabled: false },
        "7-key": { text: "7", onclick: "appendText", disabled: false },
        "8-key": { text: "8", onclick: "appendText", disabled: false },
        "9-key": { text: "9", onclick: "appendText", disabled: false },
        "enter-key": {
            text: "Enter",
            onclick: "updateCellValue",
            disabled: false,
        },
        "x-key": { text: "x", onclick: "appendText", disabled: false },
        "_-key": { text: "_", onclick: "appendText", disabled: false },
        ",-key": { text: ",", onclick: "appendText", disabled: false },
        "+-key": { text: "+", onclick: "appendText", disabled: false },
        ";-key": { text: ";", onclick: "appendText", disabled: false },
        "aptr-key": { text: "'", onclick: "appendText", disabled: false },
        "[-key": { text: "[", onclick: "appendText", disabled: false },
        "]-key": { text: "]", onclick: "appendText", disabled: false },
        "dir-key": { text: "\\", onclick: "appendText", disabled: false },
        "SPchhand-key": {
            text: "`",
            onclick: "appendSPChhand",
            disabled: true,
        },
        "shift-key": {
            text: "Shift",
            onclick: "toggleShiftKey",
            disabled: false,
        },
    },
};

function createKeyboard() {
    const keyboardContainer = document.getElementById("keylayout");
    keyboardContainer.innerHTML = "";
    let keys = keyboard[shiftKey];
    for (let key in keys) {
        const button = document.createElement("button");
        button.className = "key";
        button.id = key;
        button.disabled = keys[key].disabled;
        button.onclick = function () {
            window[keys[key].onclick](keys[key].text);
        };

        if (
            key == "chhand-key" ||
            key == "u-key" ||
            key == "U-key" ||
            key == "l-key" ||
            key == "L-key" ||
            key == "SPchhand-key"
        ) {
            const childDiv = document.createElement("div");
            childDiv.className = key;
            childDiv.textContent = keys[key].text;

            button.appendChild(childDiv);
        } else {
            button.textContent = keys[key].text;
        }
        keyboardContainer.appendChild(button);
    }
}

function toggleShiftKey() {
    shiftKey = (shiftKey + 1) % 2;
    createKeyboard();
}

// Call createKeyboard on page load
document.addEventListener("DOMContentLoaded", function () {
    createKeyboard();
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

// Function to generate row identifiers
function generateRowIdentifier(index) {
    let identifier = "";
    while (index >= 0) {
        identifier = String.fromCharCode((index % 26) + 65) + identifier;
        index = Math.floor(index / 26) - 1;
    }
    return identifier;
}

function generateTable() {
    const columnCount = parseInt(
        document.getElementById("column-count").value,
        10
    );
    const tableContainer = document.getElementById("table-container");
    tableContainer.innerHTML = ""; // Clear previous table

    cellValues.columnCount = columnCount; // Update column count

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

    for (let i = 0; i < cellValues.rowCount; i++) {
        const tr = document.createElement("tr");

        // Add row identifier cell
        const rowIdentifierCell = document.createElement("td");
        rowIdentifierCell.textContent = generateRowIdentifier(i);
        rowIdentifierCell.className = "identifier-cell"; // Add class to style
        tr.appendChild(rowIdentifierCell);

        for (let j = 0; j < columnCount; j++) {
            const td = document.createElement("td");
            td.innerHTML = `<code><input type="text" style="min-width: 150px; border: none; outline: none; font-family: ome_bhatkhande_hindi;" data-cell="${i}-${j}" onfocus="setActiveCell(this)"></code>`;

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

    // Add event listeners for arrow key navigation and input capture
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

    updateCellValuesDisplay();

    tableContainer.style.display = "block";
    document.getElementById("add-rows-button").style.display = "inline";
    document.getElementById("save-button").style.display = "inline";
    document.getElementsByClassName("keyboard-container")[0].style.display =
        "flex";
}

function addRows() {
    const addButton = document.getElementById("add-rows-button");

    if (addButton.disabled) {
        return;
    }

    addButton.disabled = true; // Disable the button
    setTimeout(() => {
        addButton.disabled = false; // Re-enable the button after 5 seconds
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
            }-${j}" onfocus="setActiveCell(this)"></code>`;

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
