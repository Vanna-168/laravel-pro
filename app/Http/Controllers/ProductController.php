<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        return view('dashboard');
    }
    public function menu()
    {
        $categories = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        $products = Product::orderBy('id', 'desc')->where('status', 1)->get();
        return view('menu', compact('products', 'categories', 'brands'));
    }
    public function index()
    {
        // $products = Product::all();
        $products = Product::orderBy('id', 'desc')->where('status', 1)->get();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        return view('product.formCreate', compact('brands', 'categories'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $file = $request->file('image')->store('images/product', 'custom');
        $data = array(
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'qty' => $request->qty,
            'size' => $request->size,
            'image' => $file,
            'stock' => $request->qty,
            'status' => 1,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
        );
        $product = Product::create($data);
        if ($product) {
            Session()->flash('success', 'Insert Success....');
            return redirect()->route('product.index');
        }
        return redirect()->route('product.index')->with('error', 'Can not insert data...');

        return redirect()->route('product.index');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.formUpdate', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            Storage::delete($products->image);
            $file = $request->file('image')->store('images/product', 'custom');
            $data['image'] = $file;
        }
        $products->update($data);
        if ($products) {
            Session()->flash('success', 'Update Success....');
            return redirect()->route('product.index');
        }
        return redirect()->route('product.index')->with('error', 'Can not update data...');
    }
    public function delete($id)
    {
        $products = Product::where('id', $id)->update(['status' => 0]);
        if ($products) {
            Session()->flash('success', 'Delete Success....');
            return redirect()->route('product.index');
        }
        return redirect()->route('product.index')->with('error', 'Can not delete data...');
    }
    public function reciept($id)
    {
        $products = Product::find($id)->where('status', 1)->get();
        return view('reciept', compact('products'));
    }
    public function search(Request $request)
    {
        $search = $request->search;

        $data['data'] = $search;
        $data['name'] = Product::where('name', 'like', '%' . $search . '%')
            ->orWhere('size', 'like', '%' . $search . '%')
            ->where('status', 1)->get();

        return view('menu', $data);
    }
}
