<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::all();
    }

    public function find($productId)
    {
        return Product::findOrFail($productId);
    }

    public function delete($productId)
    {
        return Product::destroy($productId);
    }

    public function create(array $productDetails)
    {
        return Product::create($productDetails);
    }

    public function update($productId, array $newDetails)
    {
        return Product::findOrFail($productId)->update($newDetails);
    }

    public function getTrending()
    {
        return Product::where('trending', 1)->take(15)->get();
    }
}
