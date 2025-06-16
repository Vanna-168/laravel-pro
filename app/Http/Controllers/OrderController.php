<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = $request->input('cart');
        $total_amount = $request->input('total_amount');
        Order::create([
            'user_id' => auth()->id(),
            'customer_id' => 1,
            'order_date' => now()->format('Y-m-d H:i:s'),
            'payment_method' => 'Cash',
            'payment_status' => 'unpaid',
        ]);
        foreach ($cart as $item) {
            if ($item['quantity'] > Product::find($item['id'])->stock) {
                return response()->json(['error' => false, 'message' => 'Insufficient stock for product ID: ' . $item['id']]);
            } else {
                Product::where('id', $item['id'])->decrement('stock', $item['quantity']);
            }
            OrderDetail::create([
                'order_id' => Order::get()->last()->id,
                'product_id' => $item['id'],
                'quantity'     => $item['quantity'],
                'unit_price'        => $item['price'],
                'discount_percentage' => 0,
                'discount_amount' => 0,
            ]);
        }
        return response()->json(['success' => true]);
    }
    public function reportOrder()
    {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select(
                'orders.*',
                'users.name as user_name',
                'order_details.quantity as quantity',
                'order_details.unit_price as unit_price',
                'order_details.discount_amount as discount',
                'customers.firstname as customer_fname',
                'customers.lastname as customer_lname',
            )
            ->orderBy('orders.id', 'desc')
            ->paginate(10);
        return view('report.order', compact('orders'));
    }
}
