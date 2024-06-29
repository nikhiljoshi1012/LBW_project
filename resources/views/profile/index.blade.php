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
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
@endsection
