<?php

namespace App\Contracts;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

interface ProductInterface
{
    public function create(array $product): string;
    public function getProductById(int $productID);
    public function getProductsByVendorId(int $vendorID, string $sortBy, string $sortDirection): JsonResource;
}
