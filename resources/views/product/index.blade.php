@extends('home')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <a href="{{ url('/export-product') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Export Report</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Product</h6>
        @if (Session::has('success'))
        <p class="success bg-primary p-2 rounded-2xl">{{Session('success')}}</p>
        @endif
        @if (Session::has('error'))
        <p class="error bg-danger p-2 rounded-2xl">{{Session('error')}}</p>
        @endif
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <a href="{{route('product.form')}}" class="text-white text-decoration-none">Add New</a>
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
                        <th width="5%">price</th>
                        <th width="5%">Qauntity</th>
                        <th width="5%">Size</th>
                        <th width="5%">Stock</th>
                        <th>Photo</th>
                        <th width="15%">Brand</th>
                        <th width="10%">Category</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $pro)
                    <tr>
                        <td>{{$pro->id}}</td>
                        <td>{{$pro->name}}</td>
                        <td>{{$pro->description}}</td>
                        <td>${{$pro->price}}</td>
                        <td>{{$pro->qty}}</td>
                        <td>{{$pro->size}}</td>
                        <td>{{$pro->stock}}</td>
                        <td>
                            <img src="{{asset($pro->image)}}" alt="" width="40">
                        </td>
                        <td>{{$pro->brand->name}}</td>
                        <td>{{$pro->category->name}}</td>
                        <td class="text-center">
                            <a href="{{ route('product.formupdate', $pro->id) }}" class=""><i class="fa fa-edit text-primary fs-5"></i></a>
                            <a href="{{ route('product.delete', $pro->id) }}" class="ms-2"
                                onclick="return confirm('Do you want to delete this item?')">
                                <i class="fa fa-trash text-danger fs-5"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection