<?php

namespace App\Services;

use App\Contracts\ProductInterface;
use App\Enums\SortType;
use App\Http\Resources\ProductsResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class ProductService implements ProductInterface
{
    const PRODUCT_LIST_BY_VENDOR = 'products:list:vendor:';

    public function create(array $product): string
    {
        $response = Product::create($product);

        return __('messages.product_created', ['product_name' => $response->product_title]);
    }

    public function getProductById(int $productID)
    {
        $product = Product::find($productID);

        return (!is_null($product)) ? $product->toArray() : __('messages.product_not_found', ['id' => $productID]);
    }

    public function getProductsByVendorId(int $vendorID, string $sortBy, string $sortDirection): JsonResource
    {

        $products = Cache::remember(static::PRODUCT_LIST_BY_VENDOR . $vendorID, now()->addMinutes(10),
            function () use ($vendorID, $sortBy, $sortDirection) {
                $products = Product::where('vendor_id', $vendorID)->where('stock', '>', 0);

                if ($sortBy && $sortDirection)
                    $products->orderBy($sortBy, $sortDirection);

                return ProductsResource::collection($products->get());
            }
        );

        return ProductsResource::collection($products->get());
    }
}
