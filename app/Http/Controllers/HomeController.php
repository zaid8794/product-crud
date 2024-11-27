<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $products = Product::all();
        return view('welcome',['products' => $products]);
    }
}
