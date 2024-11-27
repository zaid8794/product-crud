<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('checkout', ['cart' => $cart]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ship_name' => 'required',
            'ship_email' => 'required | email',
            'ship_phone' => 'required',
            'ship_address' => 'required',
            'payment_method' => 'required',
        ]);

        $cart = Cart::where('user_id', Auth::id())->get();
        $address = "Name : " . $request->ship_name . "<br>Email : " . $request->ship_email . "<br>Phone : " . $request->ship_phone . "<br>Address : " . $request->ship_address;
        $order_no = date("dmYHis");
        foreach ($cart as $value) {
            $order = new Order();
            $order->user_id = $value->user_id;
            $order->order_no = $order_no;
            $order->product_id = $value->product_id;
            $order->qty = $value->qty;
            $order->address = $address;
            $order->payment_method = $request->payment_method;
            $order->save();
        }
        $cartdelete = Cart::where('user_id', Auth::id())->delete();
        if ($cartdelete) {
            return redirect()->route('account.dashboard')->with('success', 'Order Submit Successfully');
        }
    }
}
