<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountedProduct;
use Illuminate\Http\Request;

class DiscountedProductController extends Controller
{
    public function addProduct(Request $request)
    {
        // dd($request->all());

        DiscountedProduct::firstOrCreate([
            'coupon_id' => $request->coupon_id,
            'product_id' => $request->product_id,
        ]);
        return redirect()->route('admin.coupons')->with('message', 'Registered Succesfully');
    }

    public function removeProduct(Request $request)
    {
        DiscountedProduct::find($request->cat_id)->delete();
        return redirect()->back()->with('message', 'Product Removed');
    }

}
