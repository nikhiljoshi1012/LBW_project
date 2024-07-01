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
                @php
                    $maxRows = count($output);
                    for ($i = 1; $i <= $maxRows; $i++) {
                        echo '<th>' . chr(64 + $i) . '</th>'; // A, B, C, ...
                    }
                @endphp
            </tr>
        </thead>
        <tbody>
            @php
                $maxColumns = 0;
                foreach ($output as $item) {
                    $maxColumns = max($maxColumns, is_countable($item) ? count($item) : 1);
                }
            @endphp
            @for ($i = 0; $i < $maxColumns; $i++)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    @foreach ($output as $item)
                        @php
                            $item = (array) $item; // Ensure $item is an array
                            $value = $item[$i] ?? ''; // Use null coalescing operator to handle undefined offsets
                        @endphp
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endfor
        </tbody>
    </table>
</body>

</html>
