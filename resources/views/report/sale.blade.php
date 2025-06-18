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
                        <th>Detail</th>
                        <th>No.</th>
                        <th>Sale Date</th>
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
                        <td><a href="javascript:void(0);" class="view-sale-detail" data-sale-id="{{ $sale->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
                            <i class="fas fa-eye"></i>
                        </td>
                        <td>{{$id++}}</td>
                        <td>{{$sale->sale_date}}</td>
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

<div class="modal bg-body fade h-50" tabindex="-1" id="kt_modal_2">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h5 class="modal-title">Sale Detail</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Invioce No</th>
                                    <th style="width: 15%">Sale Date</th>
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
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".view-sale-detail").forEach(function(btn) {
        btn.addEventListener("click", function() {
            let saleId = this.getAttribute("data-sale-id");
            let tbody = document.querySelector("#kt_modal_2 tbody");
            tbody.innerHTML = `<tr><td colspan="12">Loading...</td></tr>`;

            fetch(`/sale-detail-json/${saleId}`)
                .then(res => {
                    if (!res.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return res.json();
                })
                .then(data => {
                    tbody.innerHTML = ""; // Clear again after successful fetch
                    if (data.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="12">No sale details found.</td></tr>`;
                        return;
                    }

                    let id = 1;
                    let totalAmount = 0;
                    data.forEach(sale => {
                        const unitPrice = Number(sale.unit_price);
                        const quantity = Number(sale.quantity);
                        const discount = Number(sale.discount_amount);
                        const amount = unitPrice * quantity;

                        totalAmount += amount;

                        let row = `
                            <tr>
                                <td>${id++}</td>
                                <td>${sale.invoice_number}</td>
                                <td>${sale.sale_date}</td>
                                <td>${sale.product_name}</td>
                                <td>$${unitPrice.toFixed(2)}</td>
                                <td>${quantity}</td>
                                <td>$${discount.toFixed(2)}</td>
                                <td>$${amount.toFixed(2)}</td>
                                <td class="${sale.payment_status === 'paid' ? 'text-success' : 'text-danger'} fw-bold">
                                    ${sale.payment_status}
                                </td>
                                <td>${sale.payment_method}</td>
                                <td>${sale.user_name}</td>
                                <td>${sale.customer_fname} ${sale.customer_lname}</td>
                            </tr>`;
                        tbody.insertAdjacentHTML("beforeend", row);
                    });

                    // ✅ Add total row
                    let totalRow = `
                        <tr>
                            <td colspan="11" class="text-end fw-bold">Total Amount</td>
                            <td class="fw-bold">$${totalAmount.toFixed(2)}</td>
                        </tr>`;
                    tbody.insertAdjacentHTML("beforeend", totalRow);

                })
                .catch(err => {
                    tbody.innerHTML = `<tr><td colspan="12" class="text-danger">Failed to load sale details.</td></tr>`;
                    console.error("Fetch error:", err);
                });
        });
    });
});

</script>
@endsection