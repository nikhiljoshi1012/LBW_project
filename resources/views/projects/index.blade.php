<html>

<head>
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link
        href="https://cdn.datatables.net/v/bs5/dt-2.0.8/cr-2.0.3/date-1.5.2/fc-5.0.1/fh-4.0.1/kt-2.12.1/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.3/sr-1.4.1/datatables.min.css"
        rel="stylesheet">

    <link href="DataTables/datatables.min.css" rel="stylesheet">



    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Add this to your CSS file */
        .btn-custom {
            padding: 10px 20px;
            text-transform: uppercase;
            border-radius: 8px;
            font-size: 17px;
            font-weight: 500;
            color: #ffffff80;
            text-shadow: none;
            background: transparent;
            cursor: pointer;
            box-shadow: transparent;
            border: 1px solid #ffffff80;
            transition: 0.5s ease;
            user-select: none;
        }

        .btn-custom:hover,
        .btn-custom:focus {
            color: #ffffff;
            background: #008cff;
            border: 1px solid #008cff;
            text-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 20px #ffffff;
            box-shadow: 0 0 5px #008cff, 0 0 20px #008cff, 0 0 50px #008cff,
                0 0 100px #008cff;
        }


        /* Add this to your CSS file */






        .button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: rgb(7, 7, 7);
            border: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
            cursor: pointer;
            transition-duration: .3s;
            overflow: hidden;
            position: relative;
        }

        .svgIcon {
            width: 12px;
            transition-duration: .3s;
        }

        .svgIcon path {
            fill: rgb(0, 0, 0);
        }

        .button:hover {
            width: 140px;
            border-radius: 50px;
            transition-duration: .3s;
            background-color: rgb(255, 69, 69);
            align-items: center;
        }

        .button:hover .svgIcon {
            width: 50px;
            transition-duration: .3s;
            transform: translateY(60%);
        }

        .button::before {
            position: absolute;
            top: -20px;
            content: "Delete";
            color: white;
            transition-duration: .3s;
            font-size: 2px;
        }

        .button:hover::before {
            font-size: 13px;
            opacity: 1;
            transform: translateY(30px);
            transition-duration: .3s;
        }
    </style>

</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Welcome {{ Auth::user()->name }}</h1>
                    <h3>Projects</h3>

                    <a href="{{ route('projects.create') }}" class="btn btn-primary">
                        <span>Create New Project</span>
                    </a>
                    <div class="container -mt5">
                        <table class="table table-striped mt-3" id="myTable">
                    </div>
                    <thead>
                        <tr>
                            <th>Srno</th>
                            <th>Name</th>
                            <th>Date Created</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->created_at }}</td>
                                <td>
                                    @if ($project->trashed())
                                        <span class="text-danger">Deleted</span>
                                    @else
                                        <span class="text-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('projects.show', $project->id) }}"
                                        class="btn btn-info btn-custom">View</a>
                                    @if (!$project->trashed())
                                        <!-- Add delete button here -->
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button">
                                                <svg viewBox="0 0 448 512" class="svgIcon">
                                                    <path
                                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable(); // Corrected the selector
        });
    </script>
    <script src="DataTables/datatables.min.js"></script>

</body>

</html>
