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
}
