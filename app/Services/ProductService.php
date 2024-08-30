<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProductByProductId(int $productId): ?Product
    {
        return $this->product->where('id', $productId)->first();
    }
}
