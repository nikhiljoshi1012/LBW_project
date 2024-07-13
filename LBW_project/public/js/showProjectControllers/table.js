// table.js
class DynamicTable {
    constructor(
        tableContainerId,
        columnCountInputId,
        addRowsButtonId,
        saveButtonId,
        keyboardContainerClass
    ) {
        this.tableContainer = document.getElementById(tableContainerId);
        this.columnCountInput = document.getElementById(columnCountInputId);
        this.addRowsButton = document.getElementById(addRowsButtonId);
        this.saveButton = document.getElementById(saveButtonId);
        this.keyboardContainer = document.getElementsByClassName(
            keyboardContainerClass
        )[0];
        this.columnCount = 0;
        this.rowCount = 0;
        this.cellValues = {};
        this.activeCell = null;
    }

    generateRowIdentifier(index) {
        let identifier = "";
        while (index >= 0) {
            identifier = String.fromCharCode((index % 26) + 65) + identifier;
            index = Math.floor(index / 26) - 1;
        }
        return identifier;
    }

    setActiveCell(cell) {
        if (this.activeCell) {
            this.activeCell.parentElement.parentElement.classList.remove(
                "highlighted"
            );
        }
        this.activeCell = cell;
        this.activeCell.parentElement.parentElement.classList.add(
            "highlighted"
        );
    }

    updateCellValue() {
        if (this.activeCell) {
            this.activeCell.value =
                document.getElementById("preview-inputbox").value;
        }
    }

    generateTable() {
        this.columnCount = parseInt(this.columnCountInput.value, 10);
        this.tableContainer.innerHTML = ""; // Clear previous table
        const table = document.createElement("table");
        table.className = "table composition bhatkhande-hindi";
        this._createTableHeader(table);
        this._createTableBody(table);
        this.tableContainer.appendChild(table);
        this._addEventListeners();
        this._displayControls();
    }

    _createTableHeader(table) {
        const thead = document.createElement("thead");
        const headerRow = document.createElement("tr");
        const emptyHeaderCell = document.createElement("th");
        emptyHeaderCell.className = "identifier-cell";
        headerRow.appendChild(emptyHeaderCell);
        for (let i = 0; i < this.columnCount; i++) {
            const th = document.createElement("th");
            th.textContent = (i + 1).toString();
            th.className = "identifier-cell";
            headerRow.appendChild(th);
        }
        thead.appendChild(headerRow);
        table.appendChild(thead);
    }

    _createTableBody(table) {
        const tbody = document.createElement("tbody");
        tbody.id = "table-body";
        for (let i = 0; i < this.rowCount; i++) {
            const tr = this._createTableRow(i);
            tbody.appendChild(tr);
        }
        table.appendChild(tbody);
    }

    _createTableRow(rowIndex) {
        const tr = document.createElement("tr");
        const rowIdentifierCell = document.createElement("td");
        rowIdentifierCell.textContent = this.generateRowIdentifier(rowIndex);
        rowIdentifierCell.className = "identifier-cell";
        tr.appendChild(rowIdentifierCell);
        for (let j = 0; j < this.columnCount; j++) {
            const td = this._createTableCell(rowIndex, j);
            tr.appendChild(td);
        }
        return tr;
    }

    _createTableCell(rowIndex, columnIndex) {
        const td = document.createElement("td");
        td.innerHTML = `<code><input type="text" style="min-width: 150px; border: none; outline: none; font-family: ome_bhatkhande_hindi;" data-cell="${rowIndex}-${columnIndex}" onfocus="dynamicTable.setActiveCell(this)"></code>`;
        if ((columnIndex + 1) % 4 === 0) {
            td.classList.add("bold-right-border");
        }
        if (rowIndex % 2 === 1) {
            tr.classList.add("bold-bottom-border");
        }
        return td;
    }

    _addEventListeners() {
        // Implement event listeners for keyboard navigation, cell highlighting, etc.
    }

    _displayControls() {
        this.addRowsButton.style.display = "inline";
        this.saveButton.style.display = "inline";
        this.keyboardContainer.style.display = "flex";
    }
}

// Usage
const dynamicTable = new DynamicTable(
    "table-container",
    "column-count",
    "add-rows-button",
    "save-button",
    "keyboard-container"
);
