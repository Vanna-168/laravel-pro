<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Sale;
use App\Models\SaleDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleControler extends Controller
{
    public function complete(Request $request)
    {
        $cart = $request->input('cart');
        Sale::create([
            'user_id' => auth()->id(),
            'order_id' => Order::get()->last()->id,
            'customer_id' => 1,
            'sale_date' => now()->format('Y-m-d H:i:s'),
            'payment_status' => 'unpaid',
            'payment_method' => 'cash',
        ]);
        Order::where('id', Order::get()->last()->id)->update([
            'payment_status' => 'completed',
            'updated_at' => now(),
        ]);
        foreach ($cart as $item) {
            SaleDetail::create([
                'product_id' => $item['id'],
                'sale_id' => Sale::get()->last()->id,
                'quantity'     => $item['quantity'],
                'unit_price'        => $item['price'],
                'discount_percentage' => 0,
                'discount_amount' => 0,
            ]);
        }
        Invoice::create([
            'user_id' => auth()->id(),
            'order_id' => Order::get()->last()->id,
            'sale_id' => Sale::get()->last()->id,
            $latestId = Invoice::max('id') + 1,
            'invoice_number' => 'INV-' . str_pad($latestId, 5, '0', STR_PAD_LEFT),
            'invoice_date' => now()->format('Y-m-d H:i:s'),
        ]);
        return response()->json(['success' => true]);
        // return redirect()->route('invoice')->with('success', 'Sale completed successfully!');
    }
    public function reportSale()
    {
        $sales = DB::table('sales')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select(
                'sales.*',
                'users.name as user_name',
                'customers.firstname as customer_fname',
                'customers.lastname as customer_lname',
            )
            ->orderBy('sales.id', 'desc')
            ->paginate(10);
        return view('report.sale', compact('sales'));
    }
    public function getSaleDetailJson($id)
    {
        // $details = SaleDetail::where('sale_id', $id)->get();
        try {
            $details = DB::table('sale_details')
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
                ->where('sales.id', $id)->get();
            return response()->json($details);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
