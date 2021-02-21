@extends('layouts.app')
@section('content')

<div class="modal fade" id="update-employee-modal" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Update Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update-profile-form">
                    @csrf
                    @method('PUT')
                    <input hidden id="id" value="{{ auth()->user()->id }}">
                    <div class="mb-3">
                        <label for="last_name_up" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name='last_name' id="last_name_up" value="{{ auth()->user()->last_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="first_name_up" class="form-label">First Name</label>
                        <input type="text" class="form-control" name='first_name' id="first_name_up" value="{{ auth()->user()->first_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="position_up" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position_up" name='position' value="{{ auth()->user()->position }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender_up" class="form-label">Gender</label>
                            <select name="gender" id="gender_up" class="form-control">  
                                <option value="Male">Male</option>  
                                <option value="Female">Female</option>  
                            </select> 
                    </div>
                    <div class="mb-3">
                        <label for="contact_number_up" class="form-label">Contact number</label>
                        <input type="tel" class="form-control" minlength="11" maxlength="15" id="contact_number_up" name='contact_number' value="{{ auth()->user()->contact_number }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="update-employee-form-btn" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="update-employee-image-modal" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Update Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update-employee-image-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input hidden id="id" value="{{ auth()->user()->id }}">
                    <div class="form-group p-2">
                        <label for="">Image</label>
                        <img id="img_tmp" src="{{ asset('storage/'.auth()->user()->profile_picture) }}" onerror='this.onerror=null;this.src="{{ auth()->user()->profile_picture }}"' style="width:100%;">
                        <input class="form-control" type="file" id="profile_picture" name="profile_picture" onchange="readURL1(this);" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="update-employee-image-form-btn" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="w-50 m-auto text-center">
        <div class="alert alert-success alert-dismissible" id="employee-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <div class="alert alert-danger alert-dismissible" id="employee-danger" style="display:none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <div id="img-load">
            <img class="profile_picture mb-3" src="{{ asset('storage/'.auth()->user()->profile_picture) }}" onerror='this.onerror=null;this.src="{{ auth()->user()->profile_picture }}"' height="200" style="border-radius: 50%;" onclick='$("#update-employee-image-modal").modal("toggle");'>
        </div>
        <button class="btn btn-sm btn-dark mt-2" onclick='$("#update-employee-modal").modal("toggle");'>Edit Profile</button>
        <div class="my-4" id="profile-load">
            <h3 class="media-heading text-dark mb-2">{{ auth()->user()->last_name }} {{ auth()->user()->first_name }} </h3>
            <p class="my-1"><span class="font-weight-bold">User ID: </span>{{ auth()->user()->id }}</p>
            <p class="my-1"><span class="font-weight-bold">Position: </span>{{ auth()->user()->position }} </p>
            <p class="my-1"><span class="font-weight-bold">Email Address: </span>{{ auth()->user()->email }} </p>
            <p class="my-1"><span class="font-weight-bold">Contact Number: </span>{{ auth()->user()->contact_number }} </p>
            <p class="mt-1"><span class="font-weight-bold">Joined Almedah: </span>{{ auth()->user()->created_at->format('F Y') }}</p>
        </div>
    </div>
</div>

<script src="{{ asset('js/edit-profile.js') }}"></script>
@endsection