<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .receipt-box {
            padding: 30px;
            border: 1px solid #eee;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="receipt-box">
        <h2>Receipt</h2>
        @foreach ($products as $order)
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at }}</p>
        <p><strong>Customer:</strong>Guest</p>
        <hr>
        <h4>Items</h4>
        <ul>
            <li>{{ $order->name }} x {{ $order->quantity }} - ${{ $order->price }}</li>
        </ul>
        <hr>
        <p><strong>Total:</strong> $00</p>
        @endforeach

        
    </div>
</body>
</html>
