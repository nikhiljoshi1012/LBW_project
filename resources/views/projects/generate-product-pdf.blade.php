<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


</head>

<body>
    <h1>{{ $title }}</h1>
    <code>{{ $date }}</code>
    <p>Testing</p>

    <br>
    <table>
        <tbody>
            @if (is_array($output) || is_object($output))
                @foreach ($output as $item)
                    @if (is_array($item) || is_object($item))
                        <tr>
                            @foreach ($item as $subItem)
                                @php
                                    $decodedSubItem = json_encode($subItem);
                                @endphp
                                <td class="container" id="table-container" style="font-family: ome_bhatkhande_hindi">
                                    <code style="font-family: ome_bhatkhande_hindi">{{ $decodedSubItem }}</code>
                                </td>
                            @endforeach
                        </tr>
                    @else
                        <tr>
                            <td class="container" id="table-container" style="font-family: ome_bhatkhande_hindi">
                                <code>{{ json_encode($item) }}</code>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @else
                <tr>
                    <td class="container" id="table-container" style="font-family: ome_bhatkhande_hindi">
                        <code>{{ json_encode($output) }}</code>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
