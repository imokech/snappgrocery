<?php

namespace App\Contracts;

interface PaymentInterface
{
    public function purchase(int $productID);
}
