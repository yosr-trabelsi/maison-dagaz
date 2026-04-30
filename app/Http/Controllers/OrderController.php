<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        if (!auth()->user()->isAdmin() && $order->user_id != auth()->id()) {
            abort(403);
        }

        return view('order_details', compact('order'));
    }
}
