<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Elasticsearch;

class FrontendController extends Controller
{
    public function index()
    {
        $featured_products = Cache::get('featprods');
        $featured_categories = Cache::get('featcats');

        return view('Frontend.index', compact('featured_products', 'featured_categories'));
    }

    public function category()
    {
        $categories = Category::where('status', 0)->get();
        return view('frontend.category', compact('categories'));
    }

    public function productList()
    {
        $products = ProductTranslation::select('name')->where('locale', app()->getLocale())->get();
        $data = [];

        foreach ($products as $product)
        {
            $data[] = $product['name'];
        }

        return $data;
    }

    public function searchProduct(Request $request)
    {
        // $product = ProductTranslation::where('name', 'LIKE', '%' . $request->search . '%')->first()->product;

        $search = $request->search;

        $response = Elasticsearch::search([
            'index' => 'products',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $search,
                        'fields' => [
                            'title-' . app()->getLocale(),
                        ],
                    ],
                ],
            ],
        ]);

        $ids = array_column($response['hits']['hits'], '_id');
        $products = Product::query()->findMany($ids);

        if ($products->count() == 1) {
            return redirect(route('product.details', ['product_slug' => $products[0]->slug, 'category_slug' => $products[0]->category->slug]));
        }

        return view('frontend.search', compact('products' , 'search'));
    }

    public function view_category($category_slug)
    {
        $category = CategoryTranslation::where('slug', $category_slug)->first()->category;
        if (! $category) return redirect('/')->with('problem', __('admin/categories.delfail'));
        $products = Product::where('category_id', $category->id)->where('status', 0)->get();

        return view('frontend.products.index', compact('products', 'category'));
    }

    public function view_product($category_slug, $product_slug)
    {
        // Get Product To Display;
        $product = ProductTranslation::where('slug', $product_slug)->first()->product;

        // Get Mean Rating and Total Number of Ratings
        $ratings = Rating::where('product_id', $product->id)->get();
        $ratingCount = $ratings->count();

        if ($ratingCount > 0)
        {
            $rating = number_format($ratings->sum('rating') / $ratingCount);
        }
        else
        {
            $rating = 0;
        }

        // Get Rating by Current Authenticated user
        $userRating = Rating::where('product_id', $product->id)->where('id', Auth::id())->first()->rating ?? 0;

        // Get List of Products ordered by Authenticated User
        $orders = Auth::user()->UserDetails->orders ?? null;
        $products = collect();
        if ($orders)
        {
            foreach ($orders as $order)
            {
                foreach ($order->orders as $item)
                {
                    $products->push($item->product);
                }
            }
        }
        $owned = $products->where('id', $product->id)->all() != [] ? true : false;

        // Fetch All Reviews For this Product
        $reviews = Review::where('product_id', $product->id)->get();

        if (! $product) return redirect('/')->with('problem', __('admin/products.delfail'));
        return view('Frontend.products.details', compact('product', 'owned', 'rating', 'ratingCount','reviews', 'userRating'));
    }

}

