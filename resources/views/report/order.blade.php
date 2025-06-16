@extends('home')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Orders Report</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Export Report</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Order Date</th>
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
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$id++}}</td>
                        <td>{{$order->order_date}}</td>
                        <td>{{$order->unit_price*$order->quantity}}</td>
                        <td class="{{ $order->payment_status=='completed' ? 'text-success' : 'text-danger' }}">
                            {{$order->payment_status}}
                        </td>
                        <td>{{$order->payment_method}}</td>
                        <td>{{$order->user_name}}</td>
                        <td>{{$order->customer_fname}} {{$order->customer_lname}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection