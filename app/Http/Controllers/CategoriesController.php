<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('category.index', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        $data = array(
            'name' => $request->name,
            'description' => $request->description,
        );
        $categories = Category::create($data);
        if ($categories) {
            Session()->flash('success', 'Insert Success....');
            return redirect()->route('category.index');
        }
        return redirect()->route('category.index')->with('error', 'Can not insert data...');
    }
}
