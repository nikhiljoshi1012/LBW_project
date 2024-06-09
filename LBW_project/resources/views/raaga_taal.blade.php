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
        <label for="column-count">Select number of columns:</label>
        <select id="column-count">
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
        </select>
        <button onclick="generateTable()">Generate Table</button>
        <div class="container" id="table-container"></div>
        <button id="add-rows-button" onclick="addRows()">Add More Rows</button>
        <div id="string-output"></div>
        <script src="{{ asset('js/raag_taal.js') }}"></script>
        <div class="keyboard-container">
            <div class="preview-input">
                <code>
                    <input type="text" id="preview-inputbox" id="preview-inputbox" value="" onmouseup="getSelectedText()"/>
                </code>
                <div class="keyboard">
                    <div class="keylayout">
                        
                            <button class="key" id="SA-key" onclick="appendText('s')">s</button>
                            <button class="key" id="RE-key" onclick="appendText('r')">r</button>
                            <button class="key" id="GA-key" onclick="appendText('g')">g</button>
                            <button class="key" id="MA-key" onclick="appendText('m')">m</button>
                            <button class="key" id="PA-key" onclick="appendText('p')">p</button>
                            <button class="key" id="DHA-key" onclick="appendText('d')">d</button>
                            <button class="key" id="NI-key" onclick="appendText('n')">n</button>
                            <button class="key" id="l-key" disabled onclick="appendOctave('l')"><div class="octave-key">l</div></button>
                            <button class="key" id="L-key" disabled onclick="appendOctave('L')"><div class="octave-key">L</div></button>
                            <button class="key" id="khali-key" onclick="appendText('-')">-</button>
                            <button class="enterkey" id="enter-key"  onclick="updateCellValue()">Enter</button>
                        
                        
                            <button class="key" id="SAf-key" onclick="appendText('S')">S</button>
                            <button class="key" id="REf-key" onclick="appendText('R')">R</button>
                            <button class="key" id="GAf-key" onclick="appendText('G')">G</button>
                            <button class="key" id="MAf-key" onclick="appendText('M')">M</button>
                            <button class="key" id="PAf-key" onclick="appendText('P')">P</button>
                            <button class="key" id="DHAf-key" onclick="appendText('D')">D</button>
                            <button class="key" id="NIf-key" onclick="appendText('N')">N</button>
                            <button class="key" id="u-key"  disabled onclick="appendOctave('u')"><div class="octave-key">u</div></button>
                            <button class="key" id="U-key" disabled onclick="appendOctave('U')"><div class="octave-key">U</div></button>
                            <button class="key" id="chhand-key" disabled onclick="appendChhand()"><div class="chhand-key">@</div></button>
                           
                            <button class="somekey" id=""  onclick="">TODO</button>
                        
                    </div>
                </div>
            
            </div>
            
        </div>
    </body>
</html>