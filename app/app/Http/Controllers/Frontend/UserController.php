<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $userDetail = UserDetails::where('user_id', Auth::id())->first();
        $orders = Order::where('userdetail_id', $userDetail->id)->get();

        return view('Frontend.orders.index', compact('orders'));
    }

    public function viewdetails(Order $order)
    {

        $orderItems = $order->orders;
        $userDetails = $order->userdetail;
        return view('Frontend.orders.details', compact('order', 'orderItems', 'userDetails'));
    }
}
