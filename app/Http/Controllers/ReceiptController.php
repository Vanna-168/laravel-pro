<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceiptController extends Controller
{
    // public function show($orderId)
    // {
    //     $order = Order::with('items')->findOrFail($orderId);
    //     return view('receipt', compact('order'));
    // }
    public function reciept($id)
    {
        $products = Product::find($id)->where('status', 1)->get();
        return view('reciept', compact('products'));
    }
    public function downloadPDF($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        $pdf = Pdf::loadView('receipt', compact('order'));
        return $pdf->download("receipt-{$orderId}.pdf");
    }
}
