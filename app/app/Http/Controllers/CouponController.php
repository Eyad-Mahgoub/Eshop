<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\DiscountedProduct;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupons'));
    }

    public function create(Coupon $coupon)
    {
        $coupons = Coupon::all();
        return view('admin.coupons.create', compact('coupons'));
    }

    public function register(CouponRequest $request)
    {
        Coupon::create($request->validated());
        return redirect()->route('admin.coupons')->with('message', 'Coupon created succesfully');
    }

    public function addProduct(Request $request)
    {
        $data = $request->validate([
            'coupon_id'  => ['required', 'exists:coupons,id'],
            'product_id' => ['required', 'exists:products,id']
        ]);

        DiscountedProduct::create($data);
        return redirect()->route('admin.coupons')->with('message', 'Registered Succesfully');
    }

    public function removeProduct(Request $request)
    {
        DiscountedProduct::find($request->id)->delete();
        return redirect()->back()->with('message', 'Product Removed');
    }

    public function getDiscountDetails(Request $request)
    {
        return Coupon::where('code', $request->code)->first();
    }
}
