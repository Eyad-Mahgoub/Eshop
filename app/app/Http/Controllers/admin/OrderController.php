<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function details(Order $order)
    {
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        // dd($orderItems);
        return view('admin.order.details', compact('orderItems'));
    }
}
