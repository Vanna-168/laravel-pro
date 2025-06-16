@extends('home')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Menu</h1>
</div>
<div>

    <!-- Main Content -->
    <div class="container-fluid p-0">
        <!-- Modal -->
        <div class="modal fade" id="emptyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center text-danger">
                            <h3>No Data</h3>
                            <h1>
                                <i class="fa-solid fa-circle-xmark fw-bold fs-1 mx-auto"></i>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center text-success">
                        <h3>Checkout Success</h3>
                        <h1>
                            <i class="fa-solid fa-circle-check fw-bold fs-1 text-success mx-auto"></i>
                        </h1>
                    </div>
                </div>
                </div>
            </div>
        </div>        
        <div class="row g-0">
            <!-- Left Panel - Products -->
            <div class="col-md-9 d-flex flex-column">
                <!-- Search Bar -->
                <form action="{{route('search')}}" method="get">
                    <div class="d-flex align-items-center p-2 border-bottom">
                        <button class="btn">+</button>
                        <div class="input-group position-relative flex-grow-1 mx-2">
                            {{-- <i class="fas fa-search position-absolute start-0 top-50 translate-middle-y ms-1 text-muted"></i> --}}
                            <input type="text" name="search" class="form-control ps-4" value="" placeholder="Search">
                        </div>
                        <div class="input-group">
                                <select name="category" id="" class="form-control bg-light border-1 small">
                                    <option value="">Category</option>
                                    @foreach ($categories as $category)	
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="input-group">
                            <select name="brand" id="" class="form-control bg-light border-1 small">
                                <option value="">Brand</option>
                                @foreach ($brands as $brand)	
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <button class="btn btn-secondary ms-3" type="submit">
                                <i class="fas fa-search"></i>
                                Search
                            </button>
                        </div>
                        <button class="btn">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </form>
                <!-- Products Grid -->
                <div class="p-3 overflow-auto" style="flex: 1;">
                    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">
                        <!-- V-Neck T-Shirt -->
                        @foreach ($products as $menu)
                        <div class="col">
                            <div class="card product-card h-100 position-relative" onclick="addToCart('{{$menu->id }}','{{$menu->name }}','{{$menu->price}}','{{asset($menu->image)}}')">
                                <div class="product-image">
                                    <img src="{{asset($menu->image)}}" class="img-fluid" alt="">
                                </div>
                                <div class="card-body text-center p-2">
                                    <h6 class="card-title mb-1 fs-6">{{$menu->name}}</h6>
                                    <p class="card-text mb-1">${{$menu->price}}</p>
                                    <!-- <p class="product-variations mb-0">3 variations</p> -->
                                </div>
                                <div class="position-absolute top-0 start-0 bg-success rounded-circle py-1 px-2 text-white">{{$menu->stock}}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Panel - Cart -->
            <div class="col-md-3 p-0 shadow-lg" id="cart-panel">       
                <div class="cart-panel cart" id="receipt">
                    <div class="d-flex justify-content-between p-3 border-bottom">
                        <div class="fw-medium">Product</div>
                        <div class="fw-medium">Total</div>
                    </div>
                    <div class="cart">
                        <div id="cart-items"></div>
                        <!-- <p>Subtotal: $<span id="subtotal">0.00</span></p>
                        <p>Tax (5%): $<span id="tax">0.00</span></p>
                        <p><strong>Total: $<span id="total">0.00</span></strong></p> -->
                        <div class="border-top" id="cart-total">
                            <div class="d-flex justify-content-between p-3">
                                <div>Subtotal</div>
                                <div class="fw-medium">$<span id="subtotal">0.00</span></div>
                            </div>
                            <div class="d-flex justify-content-between p-3 border-bottom">
                                <div>Tax</div>
                                <div>$<span id="tax">0.00</span></div>
                            </div>
                            <div class="d-flex justify-content-between p-3">
                                <div class="fw-medium">Total</div>
                                <div class="fw-medium">$<span id="total">0.00</span></div>
                            </div>
                        </div>
                    </div>
                    <!-- Customer Info -->
                    {{-- <div class="d-flex justify-content-between align-items-center p-3 border-top">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user me-2 text-muted"></i>
                            <span>Customer</span>
                        </div>
                        <div>Guest</div>
                    </div> --}}

                    <!-- Checkout Button -->
                    <div class="p-3 border-top d-flex">
                        
                        <button class="btn btn-danger w-100 py-2 me-3" id="checkout-btn">
                            <i class="fa-solid fa-print me-1"></i>Checkout
                        </button>
                        <button class="btn btn-success w-100 py-2 d-none" id="complete-btn">
                            <i class="fa-solid fa-print me-1"></i>Complete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection