@extends('home')
@section('content')
    <div class="d-sm-flex align-items-center">
        <h1 class="h3 mb-2 text-gray-800">Profile</h1>
        @if (Session::has('success'))
            <p class="success bg-success p-2 rounded-2xl mx-auto text-white">{{Session('success')}}</p>
        @endif
        @if (Session::has('error'))
            <p class="error bg-danger p-2 rounded-2xl mx-auto text-white">{{Session('error')}}</p>
        @endif
    </div>
    <div class="d-flex justify-content-between mb-4">
        <div class="py-4" style="width: 120vh;">
            <div class="card border-0 shadow-lg" style="background-color: #f8f9fa;">
                <div class="card-body row">
                    <div class=" d-flex justify-content-center align-items-center col-xs-12 col-md-6">
                        <img src="{{asset($user->profile->image)}}" id="photo" width="200" height="200" 
                        class="rounded-circle border border-solid border-2 border-info" style="object-fit: cover; drop-shadow(4px 4px 0.25rem black);"/>
                    </div>
                    <div class="col-xs-12 col-md-6 mt-2 border-start border-2 border-info">
                        <table class="table table-borderless">
                            <tr>
                                {{-- <td class="fw-semibold text-info fs-5">Name</td>
                                <td class="fw-semibold text-info fs-5">:</td> --}}
                                <td class="fw-bold text-info fs-1" colspan="3">{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-info fs-5">Email</td>
                                <td class="fw-semibold text-info fs-5">:</td>
                                <td class="fw-semibold text-info fs-5">{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-info fs-5">Phone</td>
                                <td class="fw-semibold text-info fs-5">:</td>
                                <td class="fw-semibold text-info fs-5">{{$user->profile->phone ?? 'No phone number'}}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-info fs-5">Address</td>
                                <td class="fw-semibold text-info fs-5">:</td>
                                <td class="fw-semibold text-info fs-5">{{$user->profile->address ?? 'No address'}}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-info fs-5">Type</td>
                                <td class="fw-semibold text-info fs-5">:</td>
                                <td class="fw-semibold text-info fs-5">{{ $user->profile->type ?? 'No type' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-4" style="width: 50vh;">
            <div class="row mb-4">
                <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body d-flex justify-content-between">
                                <h6 class="card-title fw-semibold text-secondary">Edit Profile</h6>
                                <button class="btn btn-primary " type="submit" data-bs-toggle="modal" data-bs-target="#profileModal">
                                    Save
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <input type="file" class="form-control" name="image" id="image" onchange="loadFile(event)">
                                    <div class="invalid-feedback">
                                        Please provide a valid Photo.
                                    </div>
                                    <img src="{{asset($user->profile->image)}}" id="photo" width="100" />
                                </div>
                                <div class="mb-2">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                </div>
                                <div class="mb-2">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="hone" name="phone" value="{{ $user->profile->phone }}">
                                </div>
                                <div class="mb-2 row">
                                    <h5 class="fw-semibold mb-2 text-secondary text-center">Address</h5>
                                    <div class="col-md-6 mb-2">
                                        <label for="village" class="form-label">Village</label>
                                        <input type="text" class="form-control" name="address" id="village" value="{{ $user->profile->address }}">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="type" class="form-label">type</label>
                                        <input type="text" class="form-control" name="type" id="type" value="{{ $user->profile->type }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection