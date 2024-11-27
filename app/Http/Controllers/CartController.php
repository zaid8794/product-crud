<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart', ['cart' => $cart]);
    }

    public function store(Request $request)
    {
        $qty = 1;
        $cart = new Cart();
        $cartCheck = $cart->where('product_id', $request->product_id)->where('user_id', Auth::id())->first();
        if ($cartCheck) {
            $qty += $cartCheck->qty;
            $cartCheck->qty = $qty;
            if ($cartCheck->save()) {
                return redirect()->back()->with('success', 'Product Alredy Added to Cart');
            }
        } else {
            $cart->user_id = Auth::id();
            $cart->product_id = $request->product_id;
            $cart->qty = $qty;
            if ($cart->save()) {
                return redirect()->back()->with('success', 'Product Added to Cart Successfully');
            } else {
                return redirect()->back()->with('error', 'Product Not Added to Cart');
            }
        }
    }
    
    public function delete($id)
    {
        $cart = Cart::find($id);
        if ($cart->delete()) {
            return redirect()->back()->with('success', 'Product Deleted from cart');
        } else {
            return redirect()->back()->with('error', 'Error while removing product from cart');
        }
    }
}
