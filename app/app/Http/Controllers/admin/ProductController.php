<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\productTransaction;
use App\Models\ProductTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasfile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/product/', $filename);
            $data['image'] = $filename;
        }

        $data['status'] = $request->boolean('status');
        $data['trending'] = $request->boolean('trending');
        $data['selling_price'] = $data['original_price'] * $data['tax'];

        Product::create($data);
        Cache::put('featprods', Product::where('trending', 1)->take(15)->get());

        return redirect('/products')->with('message', __('admin/products.success'));
    }

    public function edit(Product $product)
    {
        if (! $product) return redirect('/products')->with('problem', __('admin/products.delfail'));
        return view('admin.product.edit', compact('product'));
    }

    public function update(ProductRequest $request)
    {
        $data = $request->validated();
        $product = Product::find($request->id);
        if (! $product) return redirect('/products')->with('problem', __('admin/products.delfail'));

        $data['status'] = $request->boolean('status');
        $data['trending'] = $request->boolean('trending');
        $data['selling_price'] = $data['original_price'] * $data['tax'];

        if ($request->hasfile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/product/', $filename);
            $data['image'] = $filename;
        }

        $product->update($data);
        Cache::put('featprods', Product::where('trending', 1)->take(15)->get());

        return redirect('/products')->with('message', __('admin/products.editsuccess'));
    }

    public function destroy(Product $product)
    {
        if (! $product) return redirect('/products')->with('problem', __('admin/products.delfail'));
        $product->delete();
        Cache::put('featprods', Product::where('trending', 1)->take(15)->get());
        return redirect('/products')->with('message', __('admin/products.delsuccess'));
    }

    public function addQuantity(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ]);

        $data['direction'] = 1;

        productTransaction::create($data);

        return redirect()->back()->with('message', __('admin/products.qtysuccess'));
    }
}
