<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(Client::class, function () {
        //     return ClientBuilder::create()
        //         ->setHosts(['localhost:9200'])
        //         ->build();
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // $i = Product::where('trending', 1)->take(15)->get();
        // $j = Category::where('status', 0)->where('popular', 1)->take(15)->get();

        // Cache::put('featprods', $i);
        // Cache::put('featcats', $j);

        Cache::rememberForever('featprods', function () {
            return Product::where('trending', 1)->take(15)->get();
        });
        Cache::rememberForever('featcats', function () {
            return Category::where('popular', 1)->take(15)->get();
        });

    }
}
