<?php

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Test;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', [\App\Http\Controllers\TestController::class, 'test']);
Route::post('/testsave', [\App\Http\Controllers\TestController::class, 'testsave']);
Route::get('/testgetall', [\App\Http\Controllers\TestController::class, 'testgetall']);
Route::post('/testdeletemarker', [\App\Http\Controllers\TestController::class, 'testdelmarker']);
Route::post('/testupdate', [\App\Http\Controllers\TestController::class, 'testupdate']);


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
    // Route::get('/test/{lang}', [\App\Http\Controllers\TestController::class, 'index']);

    Route::controller(\App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
        Route::get('/', 'index')                                                  ->name('home');
        Route::get('/product-list', 'productList'); // JSON
        // Route::get('/searchproduct/{search}', 'searchProduct')                            ->name('product.search');
        Route::post('/searchproduct', 'searchProduct')                            ->name('product.search');
        Route::get('/categories', 'category')                                     ->name('category');
        Route::get('/categories/{category_slug}', 'view_category')                ->name('category.details');
        Route::get('/categories/{category_slug}/{product_slug}', 'view_product')  ->name('product.details');
    });


    Route::controller(\App\Http\Controllers\Auth\UserDetailsController::class)->group(function () {
        Route::get('/userdetails', 'index')                             ->name('userdetails');
        Route::post('/storeUserDetails', 'store')                       ->name('userdetails.store');
    });

    Route::controller(\App\Http\Controllers\Frontend\RatingController::class)->group(function () {
        Route::post('/add-rating', 'rate')                              ->name('rate');
        Route::post('/add-review', 'review')                            ->name('review');
        Route::get('/delete-review/{review}', 'destroy')                ->name('review.delete');
        Route::post('/edit-review', 'edit')                             ->name('review.edit');
    });

    Route::controller(\App\http\Controllers\Frontend\CartController::class)->group(function () {
        Route::get('/cart', 'viewCart')                                 ->name('cart');
        Route::post('/add-to-cart', 'addtoCart')                        ->name('cart.add');
        Route::post('/delete-cart-item', 'deleteCartItem')              ->name('cart.delete');
        Route::post('/update-cart', 'updateCart')                       ->name('cart.update');
        Route::get('/load-cart-data', 'cartcount')                      ->name('cart.load');
    });

    Route::controller(\App\Http\Controllers\Frontend\CheckoutController::class)->group(function () {
        Route::get('/checkout', 'index')                                ->name('checkout');
        Route::post('/place-order', 'placeOrder')                       ->name('checkout.placeOrder');
    });

    Route::controller(\App\Http\Controllers\Frontend\UserController::class)->group(function () {
        Route::get('/my-orders', 'index')                               ->name('orders');
        Route::get('/my-orders/{order}', 'viewdetails')                 ->name('order.details');
    });

    Route::controller(\App\Http\Controllers\Frontend\WishListController::class)->group(function () {
        Route::get('/wishlist', 'index')                                ->name('wishlist');
        Route::post('/add-to-wishlist', 'addtoWishlist')                ->name('wishlist.add');
        Route::post('/delete-wishlist-item', 'deleteWishlistItem')      ->name('wishlist.delete');
        Route::get('/load-wishlist-data', 'cartcount')                  ->name('wishlist.load');

    });

    Auth::routes();

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::middleware(['auth', 'isAdmin'])->group(function() {

        Route::get('/dashboard', [\App\Http\Controllers\admin\AdminController::class, 'index'])->name('admin');

        Route::controller(\App\Http\Controllers\admin\OrderController::class)->group(function () {
            Route::get('/orders', 'index')                  ->name('admin.orders');
            Route::get('/orders/{order}', 'details')        ->name('admin.orders.details');
        });

        Route::controller(\App\Http\Controllers\admin\UserController::class)->group(function () {
            Route::get('/users', 'index')                   ->name('admin.users');
            Route::get('/users/{user}', 'details')          ->name('admin.users.details');
        });

        Route::controller(\App\Http\Controllers\admin\CategoryController::class)->group(function () {
            Route::get('/category', 'index')                    ->name('admin.category');
            Route::get('/add-category', 'create')               ->name("admin.category.create");
            Route::post('/add-category', 'store')               ->name('admin.category.store');
            Route::get('/edit-category/{category}', 'edit')     ->name('admin.category.edit')
                ->missing(function (Request $request) {
                    return redirect('category')->with('problem', 'Category Not Found');
                });
            Route::post('/edit-category', 'update')             ->name('admin.category.update');
            Route::get('/delete-category/{category}', 'destroy')->name('admin.category.delete')
                ->missing(function (Request $request) {
                    return redirect('category')->with('problem', 'Category Not Found');
                });
        });

        Route::controller(\App\Http\Controllers\admin\ProductController::class)->group(function () {
            Route::get('/products', 'index')                    ->name('admin.product');
            Route::get('/add-product', 'create')                ->name('admin.product.create');
            Route::post('/add-product', 'store')                ->name('admin.product.store');
            Route::get('/edit-product/{product}', 'edit')       ->name('admin.product.edit')
                ->missing(function (Request $request) {
                    return redirect('products')->with('problem', 'Product Not Found');
                });;
            Route::post('/edit-product', 'update')              ->name('admin.product.update');
            Route::get('/delete-product/{product}', 'destroy')  ->name('admin.product.delete')
                ->missing(function (Request $request) {
                    return redirect('products')->with('problem', 'Product Not Found');
                });
            Route::post('/add-quantity', 'addQuantity')         ->name('admin.product.addqty');
        });

        Route::controller(\App\Http\Controllers\admin\CouponController::class)->group(function () {
            Route::get('/coupons', 'index')                     ->name('admin.coupons');
            Route::get('/edit-coupon/{coupon}', 'edit')         ->name('admin.coupons.edit');
            Route::get('/create-coupon/{coupon}', 'create')     ->name('admin.coupons.create');
            Route::get('/coupons/test', 'test');
        });

        Route::fallback(function (Request $request) {
            return view('nopage.index');
        });
    });
});
