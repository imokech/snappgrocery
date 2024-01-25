<?php

namespace App\Http\Controllers;

use App\Services\VendorService;
use Illuminate\Http\Request;
use App\Http\Requests\GeoLocationRequest;
use App\Traits\Responsive;

class VendorController extends BaseController
{
    use Responsive;

    public function __construct(protected Request $request, protected VendorService $vendorService)
    {
        parent::__construct($request);
    }
    public function findNearVendorsByGeoLocation(GeoLocationRequest $request)
    {
        $response = $this->vendorService
            ->getNearProductsByGeoLocation(
                $request->lat,
                $request->long,
                $request->input('sort'));

        return $this->successResponse($response->toArray());
    }

    public function findVendorGroupProducts(Request $request)
    {
        $response = $this->vendorService->getGroupProductsByCategory($request->id);

        return $this->successResponse($response->toArray());
    }

}
