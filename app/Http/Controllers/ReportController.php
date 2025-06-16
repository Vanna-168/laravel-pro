<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function saleDetailReport()
    {
        $saleDetails = DB::table('sale_details')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->join('invoices', 'sales.id', '=', 'invoices.sale_id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->select(
                'sale_details.*',
                'sales.id as sale_id',
                'sales.sale_date as sale_date',
                'sales.payment_status as payment_status',
                'sales.payment_method as payment_method',
                'products.name as product_name',
                'products.size as product_size',
                'invoices.id as invoice_id',
                'invoices.invoice_number as invoice_number',
                'users.name as user_name',
                'customers.firstname as customer_fname',
                'customers.lastname as customer_lname',
            )
            ->orderBy('sale_details.id', 'desc')
            ->paginate(10);
        return view('report.saleDetail', compact('saleDetails'));
    }
    public function orderDetailReport()
    {
        $orderDetails = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('invoices', 'orders.id', '=', 'invoices.order_id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                'order_details.*',
                'orders.id as order_id',
                'orders.order_date as order_date',
                'orders.payment_status as payment_status',
                'orders.payment_method as payment_method',
                'products.name as product_name',
                'products.size as product_size',
                'invoices.id as invoice_id',
                'invoices.invoice_number as invoice_number',
                'users.name as user_name',
                'customers.firstname as customer_fname',
                'customers.lastname as customer_lname',
            )
            ->orderBy('order_details.id', 'desc')
            ->paginate(10);
        return view('report.orderDetail', compact('orderDetails'));
    }
}
