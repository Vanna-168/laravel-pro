<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceControler extends Controller
{
    public function printInvoice()
    {
        $latestId = DB::table('invoices')->orderByDesc('id')->value('id');
        $invoice = DB::table('invoices')
            ->join('users', 'invoices.user_id', '=', 'users.id')
            ->select(
                'invoices.*',
                'users.name as user_name',
            )
            ->orderByDesc('invoices.id')
            ->first();
        $invoices = DB::table('invoices')
            ->join('orders', 'invoices.order_id', '=', 'orders.id')
            ->join('sales', 'invoices.sale_id', '=', 'sales.id')
            ->join('sale_details', 'sales.id', '=', 'sale_details.sale_id')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->select(
                'invoices.*',
                'sales.id as sale_id',
                'products.name as product_name',
                'products.size as product_size',
                'products.price as product_price',
                'sale_details.quantity as product_quantity',
            )
            ->where('invoices.id', $latestId)
            ->get();

        return view('invoice.invoice', compact('invoice', 'invoices'));
    }
    // public function print($id)
    // {
    //     $invoice = Invoice::with('sale.items')->findOrFail($id);

    //     return view('invoice.print', compact('invoice'));
    // }
}
