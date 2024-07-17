<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Display Saved Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://webfonts.omenad.net/fonts.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .spinner-border {
            position: fixed;
            top: 10px;
            right: 10px;
            display: none;
            /* Initially hidden */
        }
    </style>
</head>

<body>
    <div class="">


        <!-- Your form and other content here -->
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="userInput d-flex flex-row mb-4 p-4">
                <div class="input-group">

                    <div class="btn btn-lg rounded-circle" id="backButton"> <svg width="64px" height="64px"
                            viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="0" stroke="0"
                            stroke-width="1.056">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                stroke="#CCCCCC" stroke-width="0.576"></g>
                            <g id="SVGRepo_iconCarrier">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: #5c5c5c;
                                        }
                                    </style>
                                </defs>
                                <g data-name="arrow left" id="arrow_left">
                                    <path class="cls-1"
                                        d="M22,29.73a1,1,0,0,1-.71-.29L9.93,18.12a3,3,0,0,1,0-4.24L21.24,2.56A1,1,0,1,1,22.66,4L11.34,15.29a1,1,0,0,0,0,1.42L22.66,28a1,1,0,0,1,0,1.42A1,1,0,0,1,22,29.73Z">
                                    </path>
                                </g>
                            </g>
                        </svg> </div>
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control project-name"
                            value="{{ $project->name }}">
                        <label for="project-name">Project Name</label>

                    </div>
                    <button id="load-table-button" class="btn btn-primary " type="button"><svg height="64px"
                            width="64px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                            fill="#ffffff" transform="matrix(-1, 0, 0, 1, 0, 0)rotate(0)" stroke="#ffffff"
                            stroke-width="27.136000000000003">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <style type="text/css">
                                    .st0 {
                                        fill: #ffffff;
                                    }
                                </style>
                                <g>
                                    <path class="st0"
                                        d="M403.925,108.102c-27.595-27.595-62.899-47.558-102.459-56.29L304.182,0L201.946,53.867l-27.306,14.454 l-5.066,2.654l8.076,4.331l38.16,20.542l81.029,43.602l2.277-42.859c28.265,7.546,53.438,22.53,73.623,42.638 c29.94,29.939,48.358,71.119,48.358,116.776c0,23.407-4.843,45.58-13.575,65.687l40.37,17.532 c11.076-25.463,17.242-53.637,17.242-83.219C465.212,198.306,441.727,145.904,403.925,108.102z">
                                    </path>
                                    <path class="st0"
                                        d="M296.256,416.151l-81.101-43.612l-2.272,42.869c-28.26-7.555-53.51-22.53-73.618-42.636 c-29.945-29.95-48.364-71.12-48.364-116.767c0-23.427,4.844-45.522,13.576-65.697l-40.37-17.531 c-11.076,25.53-17.242,53.723-17.242,83.228c0,57.679,23.407,110.157,61.21,147.893c27.595,27.594,62.899,47.548,102.453,56.202 l-2.716,51.9l102.169-53.878l27.455-14.454l4.988-2.643l-7.999-4.332L296.256,416.151z">
                                    </path>
                                </g>
                            </g>
                        </svg></button>
                </div>
                <div class="toolbar">

                    <div class="dropdown tool filetool-selector">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            File
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('projects.create') }}">
                                New
                            </a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#fileExplorer">
                                Open
                            </a>
                            <button type="button" class="btn btn-white dropdown-item" id="copyProjectButton"
                                data-project-id="{{ $project->id }}">
                                Make a Copy
                            </button>
                            <a class="dropdown-item border-top" id="save-option">
                                Save
                            </a>
                            <a class="dropdown-item" id="download-pdf">
                                Export as PDF
                            </a>
                            <a class="dropdown-item">
                                Share
                            </a>
                            <a class="dropdown-item border-top">
                                Move to Bin
                            </a>
                            <a class="dropdown-item border-top">
                                Print
                            </a>
                            <a class="dropdown-item border-top" data-bs-toggle="modal"
                                data-bs-target="#project-details">
                                Details
                            </a>

                        </div>
                    </div>
        </form>

        <div class="dropdown tool edit-selector">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Edit
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                <a class="dropdown-item"
                    href="javascript:(function(){if(getActiveCell()) navigator.clipboard.writeText(getActiveCell().value);})()">
                    Copy
                </a>
                <a class="dropdown-item"
                    href="javascript:(function(){if(getActiveCell()) navigator.clipboard.readText().then((copiedText) => {getActiveCell().value=copiedText;});})()">
                    Paste
                </a>
                <a class="dropdown-item border-top" href="">
                    Clear Sheet
                </a>
            </div>
        </div>

        <div class="dropdown tool view-selector">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                View
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="dropdown-item-text">
                    <div class="resizeInput-container">
                        <div class="form-floating has-validation">
                            <input type="text" class="form-control resizeInput" id="resizeRow"
                                placeholder="Rows">
                            <label for="resizeRow" style="font-size:small;">Tracks</label>
                            <div id="resizeRowFeedback" class="invalid-feedback " style="font-size:small">
                                Invalid Track Count
                            </div>
                        </div>
                        <b>X</b>
                        <div class="form-floating has-validation">
                            <input type="text" class="form-control resizeInput" id="resizeCol"
                                placeholder="Columns">
                            <label for="resizeCol" style="font-size:small;">Beats</label>
                            <div id="resizeRowFeedback" class="invalid-feedback " style="font-size:small">
                                Invalid Beat Count
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" onclick="resizeTable()"
                            id="resize-button">Resize</button>
                    </div>
                </div>
                <div class="dropdown-item-text border-top">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="showSwarKeyboard"
                            onchange="toggleKeyboard()">
                        <label class="form-check-label" for="showSwarKeyboard">
                            Show Swar Keyboard
                        </label>
                    </div>
                </div>
                <div class="dropdown-item-text border-top">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="showSwarKeyboard"
                            onchange="toggleDevKeyboard()">
                        <label class="form-check-label" for="showSwarKeyboard">
                            Show Devanagari Keyboard
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <div class="dropdown tool keyboard-selector">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Keyboard
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item"
                    href="javascript:(function(){if(typeof gamabhanaExt != 'undefined') {__predefKb='#gamabhana#'; try { handlePreDefKB(); } catch(x1) {}; gamabhanaExt.changeLayout(null); __predefLangIndex=0; try {handlePreDefLang();} catch(x2) {}; attemptRun();return; } else { t=new Date().getTime();document.body.appendChild(document.createElement('script')).src='https://www.gamabhana.com/gamabhanaWidget/?mode=custom&amp;l=0&amp;k=1&amp;n=&amp;c=devnagari&amp;q='+t;}})();">
                    gamabhana
                </a>
                <a class="dropdown-item"
                    href="javascript:(function(){if(typeof gamabhanaExt != 'undefined'){__predefKb='#fontfreedom#'; try { handlePreDefKB();} catch(x1) {}; gamabhanaExt.changeLayout(null); __predefLangIndex=0; try { handlePreDefLang();} catch(x2) {}; attemptRun();return; };t=new Date().getTime();document.body.appendChild(document.createElement('script')).src='https://www.gamabhana.com/gamabhanaWidget/?mode=custom&amp;l=0&amp;k=2&amp;n=&amp;c=devnagari&amp;q='+t;})();">
                    fontfreedom
                </a>
                <a class="dropdown-item"
                    href="javascript:(function(){if(typeof gamabhanaExt != 'undefined'){__predefKb='#inscript#';try { handlePreDefKB();} catch(x1) {}; gamabhanaExt.changeLayout(null); __predefLangIndex=0; try { handlePreDefLang(); } catch(x2) {};attemptRun();return; };t=new Date().getTime();document.body.appendChild(document.createElement('script')).src='https://www.gamabhana.com/gamabhanaWidget/?mode=custom&amp;l=0&amp;k=3&amp;n=&amp;c=devnagari&amp;q='+t;})();">
                    Inscript
                </a>
                {{-- <a class="dropdown-item"
                    href="javascript:(t13nb=window.t13nb||function(l){var t=t13nb,d=document,o=d.body,c='createElement',a='appendChild',w='clientWidth',i=d[c]('span'),s=i.style,x=o[a](d[c]('script'));if(o){if(!t.l){t.l=x.id='t13ns';o[a](i).id='t13n';i.innerHTML='Loading Transliteration';s.cssText='z-index:99;font-size:18px;background:#FFF1A8;top:0';s.position=d.all?'absolute':'fixed';s.left=((o[w]-i[w])/2)+'px';x.src='https://t13n.googlecode.com/svn/trunk/blet/rt13n.js?l='+l}}else setTimeout(t,500)})('mr')">
                    Google
                </a> --}} {{-- Not working --}}
            </div>
        </div>




    </div>
    <!-- <div class="mb-3">
  <p>Created at: <b> {{ $project->created_at }} </b></p>
  <p>Updated at: <b> {{ $project->updated_at }} </b></p>
  </div> -->
    <div id="json-string-container"></div>
    <input type="submit" id="update-button" class="btn btn-success " value="Save">
    {{-- <div class="rounded-circle btn-secondary profile">//TODO Profile</div> --}}
    </div>
    <!-- Flash Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-input-container">
        <div id="table-container"></div>
        <div class="d-flex justify-content-center mt-3">
            <button id="add-r-button" class="btn btn-secondary btn-block" onclick="addRows()" type="button"
                style="display:none">Add More
                Rows</button>

        </div>
    </div>
    <!-- Add a hidden input field to store project data -->
    <input type="hidden" name="project_data" id="project-data-input">
    <div id="string-output"></div>
    </form>
    </div>
    <div class="keyboard-container" id="keyboard-container">
        <div class="preview-input mb-3" id="keyboard-input">
            <code>
                <input type="text" id="preview-inputbox" class="preview-inputbox" value=""
                    onmouseup="getSelectedText()" class="form-control" />
            </code>
            <div class="keyboard">
                <div class="keylayout" id="keylayout">
                    <!-- Keyboard keys will go here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modals here -->
    <div class="modal fade " id="fileExplorer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display:none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Open...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-3">
                        <div class="row header-row file-item-header">
                            <div class="col">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                    onchange="toggleCheckBoxes(this)">
                            </div>
                            <div class="col">Name</div>
                            <div class="col">Date Created</div>
                            <div class="col"> </div>
                        </div>
                        @foreach ($Allprojects as $proj)
                            @if ($proj->id == $project->id)
                                @continue;
                            @endif
                            <div class="row rounded list-group-item list-group-item-action file-item">
                                <div class="col">
                                    <input class="form-check-input file-checkbox" type="checkbox" value=""
                                        id="{{ $proj->id }}" onchange="activeSelection('{{ $proj->id }}')">
                                </div>
                                <div class="col" onclick="location.href='{{ route('projects.show', $proj->id) }}'"
                                    style="cursor:pointer;">
                                    {{ $proj->name }}
                                </div>
                                <div class="col">
                                    {{ $proj->created_at }}
                                </div>
                                <div class="col">

                                    <div class="dropdown file-option-selector">
                                        <button class="btn dropdown-toggle rounded-circle filemenu-dropdown"
                                            type="button" id="" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <svg width="15px" height="15px" viewBox="0 0 16 16"
                                                xmlns="http://www.w3.org/2000/svg" fill="#5f6768"
                                                class="bi bi-three-dots-vertical" stroke="#5f6768">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ route('projects.show', $proj->id) }}"
                                                class="dropdown-item">Open</a>
                                            <div class="dropdown-item-text btn-danger" style="padding:0;">
                                                <form action="{{ route('projects.destroy', $proj->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn"
                                                        style="width:100%;height:100%; margin:0; color:white;text-align: left;"
                                                        onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Open</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Template -->
    <div class="modal fade" id="project-details" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $project->name }} Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row">Project Name</th>
                                <td>{{ $project->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Created By</th>
                                <td>{{ $project->user_id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Created At</th>
                                <td>{{ $project->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Last Modified</th>
                                <td>{{ $project->updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/script2.js') }}"></script>
    <script type="module" src="{{ asset('js/showProjectControllers/keyboard.js') }}"></script>
    <script src="https://www.gamabhana.com/gamabhanaWidget/add/?mode=custom&c=devnagari&lang=0"></script>
    <script>
        const projectData = @json($project->data);
        const projectId = "{{ $project->id }}";
        const csrfToken = "{{ csrf_token() }}";
        const url = `{{ route('projects.update', $project->id) }}`;

        function toggleCheckBoxes(checkbox) {
            console.log(checkbox.checked);
            if (checkbox.checked) {
                const checkboxes = document.getElementsByClassName('file-checkbox');
                for (let i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = true;
                    checkboxes[i].dispatchEvent(new Event('change'));
                }
            } else {
                const checkboxes = document.getElementsByClassName('file-checkbox');
                for (let i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = false;
                    checkboxes[i].dispatchEvent(new Event('change'));
                }
            }
        }
        var activeSelections = [];

        function activeSelection(id) {
            let itemID = parseInt(id);
            if (activeSelections.includes(itemID)) {
                activeSelections = activeSelections.filter(item => item !== itemID);
            } else {
                activeSelections.push(itemID);
            }
            console.log(activeSelections);
        }

        function openSelection() {
            if (activeSelections.length > 0) {
                console.log(activeSelections);
            }
        }

        const el = document.querySelector(".file-item-header")
        const observer = new IntersectionObserver(
            ([e]) => e.target.classList.toggle("is-sticky", e.intersectionRatio < 3), {
                threshold: [1]
            }
        );

        observer.observe(el);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("download-pdf").addEventListener("click", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'PDF Downloaded Successfully',
                    showConfirmButton: true,
                }).then(() => {
                    document.getElementById('pdf-download-frame').src =
                        "{{ route('download-pdf', ['id' => $project->id]) }}";
                });
            });
        });
    </script>
    <iframe id="pdf-download-frame" style="display: none;"></iframe>
</body>

</html>
