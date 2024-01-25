<?php

namespace App\Services;

use App\Contracts\ProductInterface;
use App\Contracts\VendorInterface;
use App\Http\Resources\ProductsResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class VendorService implements VendorInterface
{
    public function getNearProductsByGeoLocation(float $lat, float $long, int $sort)
    {
        /**
         * Note: it's better to set a condition to have exact near vendors by a threshold
         */
        $query = DB::table('vendors');
        $query->leftJoin('products', 'products.vendor_id', '=', 'vendors.id');
        $query->select('products.*');
        $query->selectRaw('111.111 *
                            DEGREES(ACOS(LEAST(1.0, COS(RADIANS(lat))
                                * COS(RADIANS(?))
                                * COS(RADIANS(`long` - (?)))
                                + SIN(RADIANS(lat))
                                * SIN(RADIANS(?))))) AS distance_in_km
                        ', [$lat, $long, $lat]);

        if ($sort)
            $query->orderBy('distance_in_km');

        return collect($query->get());
    }


    public function getGroupProductsByCategory(int $vendorID): JsonResource
    {
        return Product::where('vendor_id', $vendorID)->groupBy('category_id')->get();
    }
}
