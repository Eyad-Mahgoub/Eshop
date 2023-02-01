<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Razorpay\Api\Api;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\productTransaction;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;

class CheckoutController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index()
    {
        $userDetails = Cache::get('AuthUser');
        $oldCartItems = Cart::where('user_id', Auth::id())->get();

        foreach ($oldCartItems as $item)
        {
            $product = Product::where('id', $item->prod_id);
            if (! $product->exists() && $product->quantity >= $item->prod_qty)
            {
                $removeItem = Cart::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
                $removeItem->delete();
            }
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('Frontend.checkout', compact('cartItems', 'userDetails'));
    }

    public function placeOrder(Request $request)
    {
        // $data = $request->validated([
        //     'first_name'    => ['required'],
        //     'last_name'     => ['required'],
        //     'email'         => ['required'],
        //     'phone_no'      => ['required'],
        //     'address1'      => ['required'],
        //     'address2'      => ['nullable'],
        //     'city'          => ['required'],
        //     'state'         => ['required'],
        //     'country'       => ['required'],
        //     'pincode'       => ['required'],
        // ]);

        $total = 0;
        $order = new Order();
        $order->userdetail_id = Auth::id();
        $order->tracking_no = 'tracker' . rand(1111,9999);
        $order->total_price = 0;
        $order->save();

        $CartItems = Cart::where('user_id', Auth::id())->get();

        foreach ($CartItems as $item)
        {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->product->id,
                'qty' => $item->prod_qty,
                'price' => $item->product->selling_price,
            ]);

            productTransaction::create([
                'product_id' => $item->prod_id,
                'quantity' => $item->prod_qty,
                'direction' => -1
            ]);

            $total += $item->product->selling_price * $item->prod_qty;
        }

        $order->total_price = $total;
        $order->save();

        Cart::destroy($CartItems);

        if ($request->type && $request->type == 'paypal')
        {
            return response()->json(['status' => 'worked']);
        }

        return redirect('/my-orders')->with('message', __('frontend/index.successpurchase'));
    }



}
