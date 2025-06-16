@php 
  $total = 0;
 @endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Receipt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Khmer&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
  <style>
    .receipt {
      max-width: 400px;
      margin: 20px auto;
      background: #fff;
      border: 1px solid #ccc;
      padding: 30px;
      font-family: "Khmer", sans-serif;
      font-weight: 400;
      font-style: normal;
    }
    .receipt h4, .receipt h6 {
      text-align: center;
    }
    .dashed-line {
      border-top: 2px dashed #ccc;
    }
    .barcode {
      text-align: center;
    }
    .barcode img {
      width: 100%;
      max-width: 100px;
    }
    @media print {
      @page {
        size: 80mm 200mm; /* width height */
        margin: 5mm;
    }

    body {
        width: 80mm;
        font-size: 12px;
    }

    /* Hide UI elements not for printing */
    .no-print {
        display: none !important;
    }
    }
  </style>
</head>
<body class="bg-light">

  <div class="receipt shadow-sm p-4" id="receipt">
    <img src="{{asset('img/laravelshop.jpg')}}" class="w-25 mb-3 mt-3 rounded-circle d-flex mx-auto" alt=""/>
    
    {{-- <div class="dashed-line"></div> --}}
    <div class="row border border-2" style="font-size: 0.9rem;">
      <div class="col border-end">Take Away</div>
      <div class="col text-center border-end">Receipt</div>
      <div class="col text-end">VN Shop 2</div>
    </div>
    <div class="row" style="font-size: 0.9rem;">
      <div class="col">Cashier : {{$invoice->user_name}}</div>
      <div class="col-5 text-end">{{ $invoice->invoice_number }}</div>
    </div>
    <div class="row" style="font-size: 0.9rem;">
      <div class="col text-center">{{ $invoice->invoice_date }}</div>
    </div>
    <div class="row" style="font-size: 0.9rem;">
      <div class="col">Pax : 1</div>
      <div class="col-7 text-end">Counter : POS Sale</div>
    </div>
    <div class="row border border-2" style="font-size: 0.8rem;">
      <div class="col border-end text-start">Description</div>
      <div class="col border-end text-center">Size</div>
      <div class="col border-end text-center">Qty</div>
      <div class="col border-end text-center">Price</div>
      <div class="col">Amount</div>
    </div>
    @foreach ($invoices as $item)
    @php 
      $total += $item->product_price * $item->product_quantity;
    @endphp
    <div class="row" style="font-size: 0.8rem;">
      <div class="col">{{$item->product_name}}</div>
      <div class="col text-end">{{ $item->product_size }}</div>
      <div class="col text-end">{{ $item->product_quantity }}</div>
      <div class="col">${{$item->product_price}}</div>
      <div class="col">${{ $item->product_price * $item->product_quantity }}</div>
    </div>
    @endforeach
    <div class="dashed-line"></div>

    <div class="row fw-bold" style="font-size: 0.8rem;">
      <div class="col">សរុប / Subtotal</div>
      <div class="col text-end">${{ number_format($total, 2) }}</div>
    </div>
    <div class="dashed-line"></div>
    <div class="row fw-bold" style="font-size: 0.8rem;">
      <div class="col-9">សរុបចុងក្រោយ / Grand Total ($)</div>
      <div class="col text-end">${{ number_format($total, 2) }}</div>
    </div>
    <div class="row fw-bold" style="font-size: 0.8rem;">
      <div class="col-9">សរុបចុងក្រោយ / Grand Total (៛)</div>
      <div class="col text-end">៛{{number_format($total * 4100, 0)}}</div>
    </div>
    <div class="dashed-line"></div>
    <div class="row fw-bold" style="font-size: 0.8rem;">
      <div class="col-8 text-end">ABA</div>
      <div class="col text-end">${{ number_format($total, 2) }}</div>
    </div>
    <div class="dashed-line"></div>
    <div class="row fw-bold" style="font-size: 0.8rem;">
      <div class="col-8 text-end">ប្រាក់អាប់​ / Change</div>
      <div class="col text-end">៛ 0,000</div>
    </div>

    <div class="dashed-line"></div>
    <h6 class="mt-3 text-center">********** THANK YOU **********</h6>
    <div class="barcode">
      <img src="{{asset('img/qr.png')}}" alt="Barcode">
    </div>
  </div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    printDiv('receipt')
    });
        function printDiv(divId) {
            var content = document.getElementById(divId).innerHTML;
            document.body.innerHTML = content;
            window.print();
            window.onafterprint = function () {
                window.location.href = "/product/menu"; // change to your actual menu URL
            };
        }
</script>
</html>