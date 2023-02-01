<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\productTransaction;
use App\Models\User;
use App\Models\UserDetails;
use Elastic\Elasticsearch\Response\Elasticsearch as ResponseElasticsearch;
use Elasticsearch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

use function PHPSTORM_META\map;

class TestController extends Controller
{
    public function index($lang)
    {
        // App::setLocale($lang);
        // $url = \LaravelLocalization::getLocalizedURL(App::getLocale(), \URL::previous());
        // return redirect($url);
    }

    public function test(Request $request)
    {
        // dd($request->all());
        // $products = Product::all();

        // foreach ($products as $product)
        // {
        //     Elasticsearch::index([
        //         'id' => $product->id,
        //         'index' => 'products',
        //         'body' => [
        //             'title-en' => $product->translate('en')->name,
        //             'title-ar' => $product->translate('ar')->name,
        //         ],
        //     ]);
        // }
        // dd('done');
        $response = Elasticsearch::search([
            'index' => 'products',
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            ['match' => ['title-en' => 'mobile']],
                        ],
                    ],
                ],
            ],
        ]);
        // $ids = array_column($response['hits']['hits'], '_id');
        // $prod = Product::query()->findMany($ids);
        // dd($prod->count());
        $reponse = Elasticsearch::get([
            'index' => 'products',
            'id' => 'my_id',
        ]);
        dd($reponse);
    }
}
