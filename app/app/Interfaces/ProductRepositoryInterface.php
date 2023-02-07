<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function all();
    public function find($productId);
    public function delete($productId);
    public function create(array $productDetails);
    public function update($productId, array $newDetails);
    public function getTrending();
}
