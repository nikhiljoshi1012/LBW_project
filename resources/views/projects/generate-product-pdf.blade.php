<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        #h1 {
            text-align: center;
        }

        body {
            border: 1px solid black;
            margin: 0;
            padding: 3px;
        }
    </style>
</head>

<body>
    <h1 id="h1">{{ $title }}</h1>
    <br>
    <p>Date: {{ $date }}</p>
    <br>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black;">#</th>
                @for ($col = 1; $col <= $cellValues['columnCount']; $col++)
                    <th style="border: 1px solid black;">{{ $col }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @for ($row = 0; $row < $cellValues['rowCount']; $row++)
                <tr>
                    <th style="border: 1px solid black;">{{ generateRowIdentifier($row) }}</th>
                    @for ($col = 0; $col < $cellValues['columnCount']; $col++)
                        <td
                            style="border: 1px solid black; height: 30px; 
                            @if (($col + 1) % 4 === 0) border-right: 2px solid black; @endif
                            @if ($row % 2 === 1) border-bottom: 2px solid black; @endif">
                            @if (isset($cellValues['cells']["$row-$col"]))
                                <code style="font-family: ome_bhatkhande_hindi;">
                                    {{ $cellValues['cells']["$row-$col"] }}
                                </code>
                            @endif
                        </td>
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>

    @php
        function generateRowIdentifier($index)
        {
            $identifier = '';
            do {
                $identifier = chr(($index % 26) + 65) . $identifier;
                $index = floor($index / 26) - 1;
            } while ($index >= 0);
            return $identifier;
        }
    @endphp
</body>

</html>
