<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortProductsRequest;
use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;
use App\Traits\Responsive;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    use Responsive;

    public function __construct(protected Request $request, protected ProductService $productService)
    {
        parent::__construct($request);
    }

    public function store(StoreProductRequest $productRequest)
    {
        $response = $this->productService->create($productRequest->toArray());

        return $this->successResponse($response);
    }

    public function findProductById(Request $request)
    {
        $response = $this->productService->getProductById($request->id);

        return $this->successResponse($response);
    }

    public function findVendorProducts(SortProductsRequest $request)
    {
        $response = $this->productService
            ->getProductsByVendorId(
                $request->id,
                $request->input('sort_by', 'rating'),
                $request->input('sort_direction', 'asc'));

        return $this->successResponse($response);
    }
}
