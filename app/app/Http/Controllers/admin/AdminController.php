<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    public function index()
    {
        $catcount = Category::all()->count();
        $prodcount = Product::all()->count();
        $usercount = User::all()->count();
        $ordercount = Order::all()->count();
        return view('admin.index', compact('catcount', 'prodcount', 'usercount', 'ordercount'));
    }
}
