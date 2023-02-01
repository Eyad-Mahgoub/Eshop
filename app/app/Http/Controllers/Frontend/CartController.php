<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addtoCart(Request $request)
    {

        $data = $request->validate([
            'prod_id'  => ['required', 'exists:products,id'],
            'prod_qty' => ['required', 'integer'],
        ]);

        if (Cart::where('prod_id', $data['prod_id'])->where('user_id', Auth::user()->id)->exists())
        {
            return response()->json(['status' => __('frontend/index.itemincart')]);
        }

        $data['user_id'] = Auth::user()->id;

        Cart::create($data);

        $wishListItem = Wishlist::where('product_id', $data['prod_id'])->where('user_id', Auth::id());
        if ($wishListItem->exists())
        {
            $wishListItem->first()->delete();
        }

        return response()->json(['status' => __('frontend/index.addtocartsuccess')]);
    }

    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        return view('frontend.cart', compact('cartItems'));
    }

    public function deleteCartItem(Request $request)
    {
        $data = $request->input('prod_id');

        $cartItem = Cart::where('prod_id', $data)->where('user_id', Auth::user()->id);

        if ($cartItem->exists())
        {
            $cartItem->first()->delete();
            return response()->json(['status' => __('admin/products.delsuccess')]);
        }

        return response()->json(['status' => $data]);
    }

    public function updateCart(Request $request)
    {
        $data = $request->validate([
            'prod_id'   => ['required'],
            'prod_qty'  => ['required'],
        ]);

        $cartItem = Cart::where('prod_id', $data['prod_id'])->where('user_id', Auth::user()->id);

        if ($cartItem->exists())
        {
            $item = Cart::where('prod_id', $data['prod_id'])->where('user_id', Auth::user()->id)->first();
            $item->prod_qty = $data['prod_qty'];
            $item->save();

            return response()->json(['status' => $data['prod_id'] . ' youv increased it ' . $data['prod_qty']]);
        }

        return response()->json(['status' => 'you havent increased it']);
    }

    public function cartcount()
    {
        $cartcount = Cart::where('user_id', Auth::id());
        return response()->json(['count' => $cartcount->count()]);
    }
}
