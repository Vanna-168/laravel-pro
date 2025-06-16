@extends('home')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Sale Detail Report</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Export Report</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sale Details</h6>
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
                    @foreach ($saleDetails as $saleDetail)      
                    <tr>
                        <td>{{$id++}}</td>
                        <td>{{$saleDetail->invoice_number}}</td>
                        <td>{{$saleDetail->sale_date}}</td>
                        <td>{{$saleDetail->product_name}}</td>
                        <td>{{$saleDetail->unit_price}}</td>
                        <td>{{$saleDetail->quantity}}</td>
                        <td>{{$saleDetail->discount_amount}}</td>
                        <td>{{$saleDetail->unit_price*$saleDetail->quantity}}</td>
                        <td class="{{ $saleDetail->payment_status=='paid' ? 'text-success' : 'text-danger' }} fw-bold">
                            {{$saleDetail->payment_status}}
                        </td>
                        <td>{{$saleDetail->payment_method}}</td>
                        <td>{{$saleDetail->user_name}}</td>
                        <td>{{$saleDetail->customer_fname}} {{$saleDetail->customer_lname}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $saleDetails->links() }}
            </div>
        </div>
    </div>
</div>
@endsection