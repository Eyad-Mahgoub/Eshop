<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->get();
        return view('Frontend.wishlist', compact('wishlistItems'));
    }

    public function addtoWishlist(Request $request)
    {
        $red = new \Predis\Client(['host' => 'redis']);

        $data = $request->validate([
            'product_id'  => ['required', 'exists:products,id'],
        ]);

        if (Wishlist::where('product_id', $data['product_id'])->where('user_id', Auth::id())->exists())
        {
            return response()->json(['status' => 'Item Already in Wishlist']);
        }

        $data['user_id'] = Auth::user()->id;
        Wishlist::create($data);

        $red->hset('wishlist', 'smn' , $data);
        dd($red->hget('wishlist', ))

        return response()->json(['status' => 'Product Added to Wishlist']);
    }

    public function deleteWishlistItem(Request $request)
    {
        $data = $request->prod_id;

        $wishListItem = Wishlist::where('product_id', $data)->where('user_id', Auth::id());
        if ($wishListItem->exists())
        {
            $wishListItem->first()->delete();
            return response()->json(['status' => 'Product Deleted Successfully']);
        }

        return response()->json(['status' => $data]);
    }

    public function cartcount()
    {
        if (Auth::user())
        {
            $wishlistcount = Wishlist::where('user_id', Auth::id());
            return response()->json(['count' => $wishlistcount->count()]);
        }
        return response()->json(['count' => -1]);
    }
}
