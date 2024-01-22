<?php

namespace App\Http\Controllers;

use App\Http\Requests\FindProductRequest;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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

    public function find(Request $request)
    {
        $response = $this->productService->getProductById($request->id);

        return $this->successResponse($response->toArray());
    }
}
