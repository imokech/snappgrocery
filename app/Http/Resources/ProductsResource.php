<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'vendor_id' => $this->vendor_id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'title_fa' => $this->title_fa,
            'title_en' => $this->title_en,
            'product_title' => $this->product_title,
            'description' => $this->description,
            'price' => $this->price,
            'rating' => $this->rating,
            'stock' => $this->stock,
        ];
    }
}
