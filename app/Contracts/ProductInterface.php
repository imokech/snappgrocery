<?php

namespace App\Contracts;

use App\Models\Product;

interface ProductInterface
{
    public function create(array $product): string;
    public function getProductById(int $productID): Product;
}
