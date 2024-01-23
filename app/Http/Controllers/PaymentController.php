<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use App\Traits\Responsive;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    use Responsive;

    public function __construct(protected Request $request, protected PaymentService $paymentService)
    {
        parent::__construct($request);
    }

    public function purchase(Request $request)
    {
        $response = $this->paymentService->purchase($request->productId);

        return $this->successResponse($response);
    }
}
