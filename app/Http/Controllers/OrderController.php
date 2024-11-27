<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function index()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->get()
            ->groupBy('order_no');
        // return $orders;
        return view('orders', ['orders' => $orders]);
    }
}
