<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function register(CouponRequest $request)
    {
        Coupon::create($request->validated());
        return redirect()->route('admin.coupons')->with('message', 'Coupon created succesfully');
    }

    public function update(CouponRequest $request)
    {
        Coupon::find($request->id)->update($request->validated());
        return redirect()->route('admin.coupons')->with('message', 'Coupon Edited succesfully');
    }

    public function delete(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('message', 'deleted succesfully');
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
