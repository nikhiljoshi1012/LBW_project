export class Keyboard {
    constructor() {
        this.activeCell = null;
        this.shiftKey = 0;
        this.createKeyboard = this.createKeyboard.bind(this);
        this.toggleShiftKey = this.toggleShiftKey.bind(this);
    }
    static selectedText = {
        text: "",
        start: 0,
        end: 0,
    };

    static keyboard = {
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

    createKeyboard() {
        const keyboardContainer = document.getElementById("keylayout");
        keyboardContainer.innerHTML = "";
        let keys = Keyboard.keyboard[this.shiftKey];
        for (let key in keys) {
            const button = document.createElement("button");
            button.className = "key";
            button.id = key;
            button.disabled = keys[key].disabled;
            button.onclick = () => {
                this[keys[key].onclick](keys[key].text);
            };

            if (
                key === "chhand-key" ||
                key === "u-key" ||
                key === "U-key" ||
                key === "l-key" ||
                key === "L-key" ||
                key === "SPchhand-key"
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
        document.getElementById("enter-key").classList.add("btn", "btn-primary");
        document.getElementById("shift-key").classList.add("btn", "btn-primary");
        if (this.shiftKey === 1) {
            document.getElementById("shift-key").classList.add("active");
        }
        document.getElementById("showSwarKeyboard").checked = true;
    }

    toggleShiftKey() {
        this.shiftKey = (this.shiftKey + 1) % 2;
        this.createKeyboard();
    }

    appendText(char) {
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

    appendOctave(char) {
        this.getSelectedText();
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

    appendChhand() {
        const chhandList = ["@", "#", "$", "%", "^", "&", "*"];
    
        this.getSelectedText();
    
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

    appendSPChhand() {
        const chhandList = ["`", "!", "~"];
    
        this.getSelectedText();
    
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

    selectedStringLength(str) {
        const regex = /[UuLl]/g;
        const filteredStr = str.replace(regex, "");
        return filteredStr.length;
    }

    getSelectedText() {
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

    setActiveCell(cell) {
        this.activeCell = cell;
    }

    updateCellValue(text) {
        activeCell.value = document.getElementById("preview-inputbox").value;
    }
}

// export default Keyboard;
