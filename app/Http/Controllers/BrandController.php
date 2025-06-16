<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('brand.index', compact('brands'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $data = array(
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->file('image')->store('images/brand', 'custom'),
        );
        $brand = Brand::create($data);
        if ($brand) {
            Session()->flash('success', 'Insert Success....');
            return redirect()->route('brand.index');
        }
        return redirect()->route('brand.index')->with('error', 'Can not insert data...');
    }
}
