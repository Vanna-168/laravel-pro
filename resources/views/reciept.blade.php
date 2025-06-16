@extends('home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reciept</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            </div>
        </div>
    </div>
</div>
@endsection