<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $request->status == TRUE ? '1' : '0';
        $data['trending'] = $request->trending == TRUE ? '1' : '0';
        if ($request->hasFile('image')) {
            $imageName = date('YmdHis') . " . " . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/product'), $imageName);
            $data['image'] = $imageName;
        }
        Product::create($data);
        return redirect()->route('products.index')->with('status','New Product Successfully added');
    }

    public function edit($id) 
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {   
        $data = $request->validated();
        $data['status'] = $request->status == TRUE ? '1' : '0';
        $data['trending'] = $request->trending == TRUE ? '1' : '0';

        if ($request->hasFile('image')) {
            $path = 'images/product/'.$product->image;
            if (file_exists($path)) {
                File::delete($path);
            }
            $imageName = date('YmdHis') . " . " . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/product'), $imageName);
            $data['image'] = $imageName;
        }
        $product->update($data);
        return redirect()->route('products.index')->with('status','Product Successfully updated');
    }

    public function destroy(Product $product) 
    {
        if ($product->image) {
            $path = 'images/product/'.$product->image;
            if (file_exists($path)) {
                File::delete($path);
            }
        }
        $product->delete();
        return redirect()->route('products.index')->with('status','Product Successfully deleted');
    }
}
