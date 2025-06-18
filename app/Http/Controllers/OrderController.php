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
            ->select(
                'orders.*',
                'users.name as user_name',
                'customers.firstname as customer_fname',
                'customers.lastname as customer_lname',
            )
            ->orderBy('orders.id', 'desc')
            ->paginate(10);
        return view('report.order', compact('orders'));
    }
    public function getOrderDetailJson($id)
    {
        // $details = OrderDetail::where('order_id', $id)->get();
        try {
            $details = DB::table('order_details')
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
                ->where('orders.id', $id)->get();
            return response()->json($details);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
