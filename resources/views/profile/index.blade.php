<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <section style="background-color: #eee;">
                        <div class="container py-2">
                            <div class="row">
                                <div class="col">
                                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('/images') }}/{{ $userprofile->picture }}" alt="avatar"
                                                class="rounded-circle bg-dark img-fluid" style="width: 150px;">

                                            <div class="row justify-content-center p-2">
                                                <a href="javascript:void(0)" id="upload_pic" class="text-lg text-bold"
                                                    data-toggle="modal" data-target="#ProfilePicModal">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                            </div>

                                            <h5 class="my-3">{{ $userinfo->name }}</h5>
                                            <p class="text-muted mb-1">{{ $userinfo->email }}</p>
                                            <div class="d-flex justify-content-center mb-2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Mobile Number</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $userprofile->mobile }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Address</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $userprofile->address }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Status</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $userprofile->status }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Company Name</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $userprofile->company }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Position</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ $userprofile->position }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                                        data-toggle="modal" data-target="#proInfoModal"><i
                                                            class="fa fa-edit"></i> Edit Profile Info</a>
                                                </div>
                                                <div class="col-sm-9"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>



    <!--Update Profile Pic Modal -->
    <div class="modal fade" id="ProfilePicModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-dark">
                <div class="modal-header bg-light">
                    <h2 class="card-title">Update Profile Picture</h2>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <img src="{{ asset('/images') }}/{{ $userprofile->picture }}" alt="avatar"
                                    class="rounded-circle bg-dark img-fluid" style="width: 150px;">
                            </div>
                            <div class="col-md-6">
                                <form id="avatar-form" enctype="multipart/form-data" action="{{ route('updatepic') }}"
                                    method="POST">
                                    @csrf
                                    <div class="card-body text-center">
                                        <input type="hidden" name="userid" value="{{ $userprofile->user_id }}">
                                        <div class="row pt-3 justify-content-center">
                                            <input id="avatar" type="file" name="avatar"
                                                class="form-control-sm text-bg-dark">
                                        </div>
                                    </div>
                                    <div class="card-body py-2 text-center">
                                        <button type="submit" class="btn btn-sm btn-success p-1">Save Picture</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Update Profile Info Modal -->
    <div class="modal fade" id="proInfoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-dark">
                <div class="modal-header bg-light">
                    <h2 class="card-title">Update Profile Info</h2>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="info-form" enctype="multipart/form-data" action="{{ route('updateinfo') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="userid" value="{{ $userprofile->user_id }}">
                            <div class="row ">
                                <div class="col-sm-4 ">
                                    <p class="mb-0">Mobile Number</p>
                                </div>
                                <div class="col-sm-8 pull-right">
                                    <input type="text" class="form-control" name="updmobile" id="updmobile"
                                        value="{{ $userprofile->mobile }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="updaddress" id="updaddress"
                                        value="{{ $userprofile->address }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Status</p>
                                </div>
                                <div class="col-sm-5">
                                    <select class="form-control" name="updStatus" id="updStatus">
                                        <option value="{{ $userprofile->status }}" selected>{{ $userprofile->status }}
                                        </option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Company Name</p>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="updcompany" id="updcompany"
                                        value="{{ $userprofile->company }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Position</p>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="updposition" id="updposition"
                                        value="{{ $userprofile->position }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-success">Save Profile Info Update</button>
                                </div>
                                <div class="col-sm-4"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
