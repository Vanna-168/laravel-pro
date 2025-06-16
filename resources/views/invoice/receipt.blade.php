<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Receipt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .receipt {
      max-width: 400px;
      margin: 30px auto;
      background: #fff;
      border: 1px solid #ccc;
      padding: 20px;
      font-family: monospace;
    }
    .receipt h4, .receipt h6 {
      text-align: center;
    }
    .dashed-line {
      border-top: 2px dashed #ccc;
      margin: 10px 0;
    }
    .barcode {
      text-align: center;
      margin-top: 20px;
    }
    .barcode img {
      width: 100%;
      max-width: 200px;
    }
  </style>
</head>
<body class="bg-light">

  <div class="receipt shadow-sm p-3">
    <h6>********** RECEIPT **********</h6>
    <h4 class="mt-3">COMPANY NAME</h4>
    <p class="text-center mb-0">Street 26 LLX South</p>
    <p class="text-center">Lorem Ipsum<br>127830236251</p>
    
    <div class="dashed-line"></div>

    <div class="row">
      <div class="col">1x T-shirt</div>
      <div class="col text-end">$ 19.00</div>
    </div>
    <div class="row">
      <div class="col">1x Pants</div>
      <div class="col text-end">$ 59.00</div>
    </div>
    <div class="row">
      <div class="col">1x Shirt</div>
      <div class="col text-end">$ 39.00</div>
    </div>
    <div class="row">
      <div class="col">1x Shoes</div>
      <div class="col text-end">$ 199.00</div>
    </div>
    <div class="row">
      <div class="col">1x Socks</div>
      <div class="col text-end">$ 55.00</div>
    </div>

    <div class="dashed-line"></div>

    <div class="row fw-bold">
      <div class="col">TOTAL</div>
      <div class="col text-end">$ 371.00</div>
    </div>
    <div class="row">
      <div class="col">Cash</div>
      <div class="col text-end">$ 400.00</div>
    </div>
    <div class="row">
      <div class="col">Change</div>
      <div class="col text-end">$ 29.00</div>
    </div>
    <h6 class="mt-3 text-center">********** THANK YOU **********</h6>
    <div class="barcode">
      <img src="{{asset('img/qr.png')}}" alt="Barcode">
    </div>
  </div>

</body>
</html>
