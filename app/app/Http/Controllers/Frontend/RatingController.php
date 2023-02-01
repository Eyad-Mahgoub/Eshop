<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RatingController extends Controller
{
    public function rate(Request $request)
    {

        $data = $request->validate([
            'product_id' => ['required'],
            'product_rating' => ['required'],
        ]);

        $rating = Rating::where('user_id', Auth::id())->where('product_id', $data['product_id'])->first();

        // dd($request->all(), $data, $rating);

        if ($rating)
        {
            $rating->rating = $data['product_rating'];
            $rating->save();
            return redirect()->back()->with('message', 'Thank you for Rating This Product');
        }

        Rating::create([
            'user_id' => Auth::id(),
            'product_id' => $data['product_id'],
            'rating' => $data['product_rating']
        ]);
        return redirect()->back()->with('message', 'Thank you for Rating This Product');

    }

    public function review(Request $request)
    {
        $data = $request->validate([
            'rating_id' => ['required'],
            'product_id' => ['required'],
            'review' => ['required'],
        ]);
        $data['user_id'] = Auth::id();
        // dd($data);

        Review::create($data);
        return redirect()->back()->with('message', 'Thank you for Reviewing This Product');
    }

    public function destroy(Review $review)
    {
        if (!$review) return redirect()->back()->with('problem', 'Error Occurred');
        $review->delete();
        return redirect()->back()->with('message', 'Review Deleted');
    }

    public function edit(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required'],
            'review' => ['required'],
        ]);

        $review = Review::where('product_id', $data['product_id'])->where('user_id', Auth::id())->first();

        $review->review = $data['review'];
        $review->save();

        return redirect()->back()->with('message', 'Review Edited Successfuly');
    }
}
