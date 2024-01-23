<?php

namespace App\Contracts;

use Illuminate\Http\Resources\Json\JsonResource;

interface VendorInterface
{
    public function getNearProductsByGeoLocation(float $lat, float $long, int $sort);
    public function getGroupProductsByCategory(int $vendorID): JsonResource;
}
