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

        #watermark {
            position: fixed;

            /**
                    Set a position in the page for your image
                    This should center it vertically
                **/
            bottom: 10cm;
            left: 5.5cm;

            /** Change image dimensions**/
            width: 8cm;
            height: 8cm;

            /** Your watermark should be behind every content**/
            z-index: -1000;
    </style>
</head>

<body>

    <h1 id="h1">{{ $title }}</h1>
    <br>
    <p>{{ $date }}</p>
    <br>

    <table>
        <tbody>
            @if (is_array($output) || is_object($output))
                @foreach ($output as $item)
                    @if (is_array($item) || is_object($item))
                        <tr>
                            @foreach ($item as $subItem)
                                @php
                                    $decodedSubItem = json_decode(json_encode($subItem), true);
                                @endphp
                                @if (!is_numeric($decodedSubItem))
                                    <td class="container" id="table-container" style="font-family: ome_bhatkhande_hindi">
                                        <code style="font-family: ome_bhatkhande_hindi">{{ $decodedSubItem }}</code>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @else
                        @if (!is_numeric($item))
                            <tr>
                                <td class="container" id="table-container" style="font-family: ome_bhatkhande_hindi">
                                    <code>{{ json_decode(json_encode($item), true) }}</code>
                                </td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            @else
                @if (!is_numeric($output))
                    <tr>
                        <td class="container" id="table-container" style="font-family: ome_bhatkhande_hindi">
                            <code>{{ json_decode(json_encode($output), true) }}</code>
                        </td>
                    </tr>
                @endif
            @endif
        </tbody>
    </table>
</body>

<script></script>

</html>
