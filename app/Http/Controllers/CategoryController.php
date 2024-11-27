<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function index()
    {
        $category = Category::all();
        return view('category', ['category' => $category]);
    }

    function create()
    {
        return view('category-create');
    }

    function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required | unique:categories',
            'category_description' => 'required'
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
        $category->slug = Str::slug($request->category_name, '-');
        if ($category->save()) {
            return redirect()->route('category.index')->with('success', 'Category Added Successfully');
        } else {
            return redirect()->route('category.create')->with('error', 'Category Not Added Successfully');
        }
    }

    function edit($id)
    {
        $category = Category::find($id);
        return view('category-edit', ['category' => $category]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required | unique:categories',
            'category_description' => 'required'
        ]);

        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
        $category->slug = Str::slug($request->category_name, '-');
        if ($category->save()) {
            return redirect()->route('category.index')->with('success', 'Category updated Successfully');
        } else {
            return redirect()->route('category.create')->with('error', 'Category Not updated');
        }
    }

    function delete($id)
    {
        $category = Category::find($id);
        if ($category->delete()) {
            return redirect()->route('category.index')->with('success', 'Category deleted Successfully');
        } else {
            return redirect()->route('category.index')->with('error', 'Category Not deleted');
        }
    }
}
