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
        .ui-btn {
            --btn-default-bg: rgb(41, 41, 41);
            --btn-padding: 15px 20px;
            --btn-hover-bg: rgb(51, 51, 51);
            --btn-transition: .3s;
            --btn-letter-spacing: .1rem;
            --btn-animation-duration: 1.2s;
            --btn-shadow-color: rgba(0, 0, 0, 0.137);
            --btn-shadow: 0 2px 10px 0 var(--btn-shadow-color);
            --hover-btn-color: #FAC921;
            --default-btn-color: #fff;
            --font-size: 16px;
            /* 👆 this field should not be empty */
            --font-weight: 600;
            --font-family: Menlo, Roboto Mono, monospace;
            /* 👆 this field should not be empty */
        }

        /* button settings 👆 */

        .ui-btn {
            box-sizing: border-box;
            padding: var(--btn-padding);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--default-btn-color);
            font: var(--font-weight) var(--font-size) var(--font-family);
            background: var(--btn-default-bg);
            border: none;
            cursor: pointer;
            transition: var(--btn-transition);
            overflow: hidden;
            box-shadow: var(--btn-shadow);
            text-decoration: none;
            /* Ensure link looks like a button */
        }

        .ui-btn span {
            letter-spacing: var(--btn-letter-spacing);
            transition: var(--btn-transition);
            box-sizing: border-box;
            position: relative;
            background: inherit;
        }

        .ui-btn span::before {
            box-sizing: border-box;
            position: absolute;
            content: "";
            background: inherit;
        }

        .ui-btn:hover,
        .ui-btn:focus {
            background: var(--btn-hover-bg);
        }

        .ui-btn:hover span,
        .ui-btn:focus span {
            color: var(--hover-btn-color);
        }

        .ui-btn:hover span::before,
        .ui-btn:focus span::before {
            animation: chitchat linear both var(--btn-animation-duration);
        }

        @keyframes chitchat {
            0% {
                content: "#";
            }

            5% {
                content: ".";
            }

            10% {
                content: "^{";
            }

            15% {
                content: "-!";
            }

            20% {
                content: "#$_";
            }

            25% {
                content: "№:0";
            }

            30% {
                content: "#{+.";
            }

            35% {
                content: "@}-?";
            }

            40% {
                content: "?{4@%";
            }

            45% {
                content: "=.,^!";
            }

            50% {
                content: "?2@%";
            }

            55% {
                content: "\;1}]";
            }

            60% {
                content: "?{%:%";
                right: 0;
            }

            65% {
                content: "|{f[4";
                right: 0;
            }

            70% {
                content: "{4%0%";
                right: 0;
            }

            75% {
                content: "'1_0<";
                right: 0;
            }

            80% {
                content: "{0%";
                right: 0;
            }

            85% {
                content: "]>'";
                right: 0;
            }

            90% {
                content: "4";
                right: 0;
            }

            95% {
                content: "2";
                right: 0;
            }

            100% {
                content: "";
                right: 0;
            }
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

                    <a href="{{ route('projects.create') }}" class="ui-btn">
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
                                    <a href="{{ route('projects.show', $project->id) }}"
                                        class="btn btn-info btn-custom">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    <!-- Corrected jQuery script tag -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- DataTables script should be after jQuery script -->
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="<script src="
        https://cdn.datatables.net/v/bs5/dt-2.0.8/cr-2.0.3/date-1.5.2/fc-5.0.1/fh-4.0.1/kt-2.12.1/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.3/sr-1.4.1/datatables.min.js">
    </script>
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable(); // Corrected the selector
        });
    </script>

    <script src="DataTables/datatables.min.js"></script>
    <script></script>
</body>

</html>
