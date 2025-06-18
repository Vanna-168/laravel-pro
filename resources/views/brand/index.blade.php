@extends('home')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Export Report</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Brand</h6>
        @if (Session::has('success'))
        <p class="success bg-primary p-2 rounded-2xl">{{Session('success')}}</p>
        @endif
        @if (Session::has('error'))
        <p class="error bg-danger p-2 rounded-2xl">{{Session('error')}}</p>
        @endif
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add New
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th >Photo</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                @php
                $id=1;
                @endphp
                <tbody>
                    @foreach ($brands as $brand)
                    <tr>
                        <td>{{$id++}}</td>
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->description}}</td>
                        <td><img src="{{asset($brand->image)}}" alt="" width="40"></td>
                        <td class="text-center">
                            <a href="" class=""><i class="fa fa-edit fs-5"></i></a>
                            <a href="" class=""><i class="fa fa-trash text-danger fs-5 ms-3"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $brands->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Modal Form -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Brand Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                                <div class="invalid-feedback">
                                    Please provide a valid Name Brand.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description" class="col-form-label">Description</label>
                                <input type="text" class="form-control" name="description" id="description">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image" class="col-form-label">Photo</label>
                                <input type="file" class="form-control" name="image" id="image" onchange="loadFile(event)" required>
                                <div class="invalid-feedback">
                                    Please provide a valid Photo.
                                </div>
                            </div>
                            <img src="{{asset('img/photo.jpg')}}" id="photo" width="100" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>