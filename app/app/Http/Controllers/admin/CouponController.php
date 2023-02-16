<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Category;
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

    public function getDiscountDetails(Request $request)
    {
        return Coupon::where('code', $request->code)->first();
    }

    public function getprods(Request $request)
    {
        return Category::find($request->id)->products;
    }

}
