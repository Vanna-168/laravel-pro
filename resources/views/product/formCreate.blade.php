@extends('home')

@section('content')
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div> -->
<div class="container w-50 bg-white shadow rounded">
    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                    <div class="invalid-feedback">
                        Please provide a valid city.
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
                    <label for="price" for="price" class="col-form-label">Price</label>
                    <input type="number" class="form-control" name="price" id="price" required>
                    <div class="invalid-feedback">
                        Please provide a valid Price.
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="quantity" class="col-form-label">Quantity</label>
                    <input type="number" class="form-control" name="qty" id="quantity" required>
                    <div class="invalid-feedback">
                        Please provide a valid Quantity.
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Brand</label>
                    <!-- <input type="text" class="form-control" id="recipient-name"> -->
                    <select class="form-control" id="recipient-name" name="brand">
                        @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Category</label>
                    <!-- <input type="text" class="form-control" id="recipient-name"> -->
                    <select class="form-control" id="recipient-name" name="category">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 row">
                <div class="form-group col-md-6">
                    <label for="size" class="col-form-label">Size</label>
                    <input type="text" class="form-control" name="size" id="size" required>
                    <div class="invalid-feedback">
                        Please provide a valid Size.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="stock" class="col-form-label">Stock</label>
                    <input type="number" class="form-control" name="stock " id="stock" required>
                    <div class="invalid-feedback">
                        Please provide a valid Stock.
                    </div>
                </div>
            </div>
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
            <button type="button" class="btn btn-danger text-decoration-none" data-dismiss="modal" id="close">
                <a href="{{route('product.index')}}" class="text-decoration-none text-white">Close</a>
            </button>
            <button type="submit" class="btn btn-success m-3">Save</button>
        </div>
    </form>
</div>
@endsection