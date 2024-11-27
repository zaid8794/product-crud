<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        $product = Product::with('category')->get();
        return view('product', ['product' => $product]);
    }

    function create()
    {
        $category = Category::all();
        return view('product-create', ['category' => $category]);
    }

    function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'product_image' => 'required',
        ]);

        $file = $request->file('product_image');
        $path = $file->store('uploads', 'public');
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        $product->product_image = $path;
        $product->slug = Str::slug($request->product_name, '-');
        if ($product->save()) {
            return redirect()->route('product.index')->with('success', 'Product Added Successfully');
        } else {
            return redirect()->route('product.create')->with('error', 'Product Not Added Successfully');
        }
    }

    function edit($id)
    {
        $product = Product::with('category')->find($id);
        $category = Category::where('id', '!=', $product->category_id)->get();
        return view('product-edit', ['product' => $product, 'category' => $category]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
        ]);
        if ($request->file('new_product_image') == null) {
            $product_image = $request->input('old_product_image');
        } else {
            $file = $request->file('new_product_image');
            $path = $file->store('uploads', 'public');
            $product_image = $path;
        }
        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        $product->product_image = $product_image;
        $product->slug = Str::slug($request->product_name, '-');
        if ($product->save()) {
            return redirect()->route('product.index')->with('success', 'Product updated Successfully');
        } else {
            return redirect()->route('product.create')->with('error', 'Product Not updted');
        }
    }

    function delete($id)
    {
        $product = Product::find($id);
        if ($product->delete()) {
            return redirect()->route('product.index')->with('success', 'Product deleted Successfully');
        } else {
            return redirect()->route('product.index')->with('error', 'Product Not deleted');
        }
    }

    function slug($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->first();
        $relatedProduct = Product::with('category')->where('category_id', $product->category->id)->where('id', '!=', $product->id)->get();
        return view('product-details', ['product' => $product, 'relatedProduct' => $relatedProduct]);
    }
}
