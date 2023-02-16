<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderItemCollection;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Marker;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\productTransaction;
use App\Models\User;
use App\Models\UserDetails;
use App\Repositories\ProductRepository;
use Database\Factories\OrderItemFactory;
use Elastic\Elasticsearch\Response\Elasticsearch as ResponseElasticsearch;
use Elasticsearch;
use Elasticsearch\Endpoints\Update;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

use function PHPSTORM_META\map;

class TestController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index($lang)
    {
        // App::setLocale($lang);
        // $url = \LaravelLocalization::getLocalizedURL(App::getLocale(), \URL::previous());
        // return redirect($url);
    }

    public function test(Request $request)
    {
        $markers = json_encode(Marker::all());
        return view('test.indexfinal', compact('markers'));
    }

    public function testsave(Request $request)
    {
        $data = $request->all();

        Marker::create($data);

        return json_encode(Marker::all());
    }

    public function testgetall(Request $request)
    {
        return Marker::all();
    }

    public function testdelmarker(Request $request)
    {
        Marker::find($request->id)->delete();
        return ['msg' => 'Marker Deleted'];
    }

    public function testupdate(Request $request)
    {
        $marker = Marker::find($request->id);
        $marker->name = $request->name;
        $marker->description = $request->description;

        $marker->update();

        return ['msg' => 'Marker Updated'];
    }
}
