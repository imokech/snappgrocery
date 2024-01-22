<?php

namespace App\Services;

use App\Contracts\ProductInterface;
use App\Models\Order;
use App\Models\Product;

class ProductService implements ProductInterface
{
    public function create(array $product): string
    {
        $response = Product::create($product);

        // simple message
        return __('messages.product_created', ['product_name' => $response->product_title]);
    }

    public function getProductById(int $productID): Product
    {
        return Product::find($productID);
    }
}
