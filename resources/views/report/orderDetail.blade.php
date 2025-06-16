@extends('home')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Orders Detail Report</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Export Report</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Invioce No</th>
                        <th style="width: 15%">Order Date</th>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Payment Method</th>
                        <th>Employee</th>
                        <th>Customer</th>
                    </tr>
                </thead>
                @php
                    $id=1;
                @endphp
                <tbody>
                    @foreach ($orderDetails as $orderDetail)      
                    <tr>
                        <td>{{$id++}}</td>
                        <td>{{$orderDetail->invoice_number}}</td>
                        <td>{{$orderDetail->order_date}}</td>
                        <td>{{$orderDetail->product_name}}</td>
                        <td>{{$orderDetail->unit_price}}</td>
                        <td>{{$orderDetail->quantity}}</td>
                        <td>{{$orderDetail->discount_amount}}</td>
                        <td>{{$orderDetail->unit_price*$orderDetail->quantity}}</td>
                        <td class="{{ $orderDetail->payment_status=='completed' ? 'text-success' : 'text-danger' }} fw-bold">
                            {{$orderDetail->payment_status}}
                        </td>
                        <td>{{$orderDetail->payment_method}}</td>
                        <td>{{$orderDetail->user_name}}</td>
                        <td>{{$orderDetail->customer_fname}} {{$orderDetail->customer_lname}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $orderDetails->links() }}
            </div>
        </div>
    </div>
</div>
@endsection