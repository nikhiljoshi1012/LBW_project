<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

    <table>
        <thead>
            <tr>
                <th>#</th>
                @if (isset($output[0]) && (is_array($output[0]) || is_object($output[0])))
                    @php
                        $columns = is_array($output[0]) ? count($output[0]) : count((array) $output[0]);
                    @endphp
                    @for ($i = 1; $i <= $columns; $i++)
                        <th>{{ $i }}</th>
                    @endfor
                @endif
            </tr>
        </thead>
        <tbody>
            @php $rowNum = 1; @endphp <!-- Initialize row counter -->
            @if (is_array($output) || is_object($output))
                @foreach ($output as $index => $item)
                    <tr>
                        <td>{{ chr(64 + $rowNum) }}</td> <!-- Display row letter (A, B, C, ...) -->
                        @if (is_array($item) || is_object($item))
                            @php $colNum = 1; @endphp <!-- Initialize column counter -->
                            @foreach ($item as $subItem)
                                @php
                                    $decodedSubItem = json_decode(json_encode($subItem), true);
                                @endphp
                                <td class="container" id="table-container" style="font-family: ome_bhatkhande_hindi">
                                    <code style="font-family: ome_bhatkhande_hindi">{{ $decodedSubItem }}</code>
                                </td>
                                @php $colNum++; @endphp <!-- Increment column counter -->
                            @endforeach
                        @else
                            <td class="container" id="table-container" style="font-family: ome_bhatkhande_hindi">
                                <code>{{ json_decode(json_encode($item), true) }}</code>
                            </td>
                        @endif
                    </tr>
                    @php $rowNum++; @endphp <!-- Increment row counter -->
                @endforeach
            @else
                <tr>
                    <td>{{ chr(64 + $rowNum) }}</td> <!-- Display row letter (A, B, C, ...) -->
                    <td class="container" id="table-container" style="font-family: ome_bhatkhande_hindi">
                        <code>{{ json_decode(json_encode($output), true) }}</code>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
