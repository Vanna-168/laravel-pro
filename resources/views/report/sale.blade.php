@extends('home')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Sales Report</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Export Report</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sales</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Sale Date</th>
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
                    @foreach ($sales as $sale)
                    <tr>
                        <td>{{$id++}}</td>
                        <td>{{$sale->sale_date}}</td>
                        <td>{{$sale->unit_price*$sale->quantity}}</td>
                        <td class="{{ $sale->payment_status=='paid' ? 'text-success' : 'text-danger' }} fw-bold">
                            {{$sale->payment_status}}
                        </td>
                        <td>{{$sale->payment_method}}</td>
                        <td>{{$sale->user_name}}</td>
                        <td>{{$sale->customer_fname}} {{$sale->customer_lname}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $sales->links() }}
            </div>
        </div>
    </div>
</div>
@endsection