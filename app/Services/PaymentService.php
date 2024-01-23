<?php

namespace App\Services;

use App\Contracts\PaymentInterface;
use App\Models\Product;

class PaymentService implements PaymentInterface
{
    public function purchase(int $productID)
    {
        $product = Product::find($productID);
        $stock = $product->stock;

        if ($stock < 1)
            return __('messages.fail_payment_due_to_stock_limit', ['name' => $product->title_fa]);

        $product->stock = $stock - 1;
        $product->save();

        return __('messages.successful_payment', ['name' => $product->title_fa]);
    }
}
