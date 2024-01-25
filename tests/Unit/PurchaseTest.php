<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use DatabaseMigrations;

    public function testProductStock_decreaseProductStock_expectTrue(): void
    {
        $product = Product::factory()->create();
        $oldStock = $product->stock;

        $response = $this->get("/api/v1/payment/{$product->id}/product");

        $response->assertStatus(201)
                ->assertSee($product->product_title);

        $product->refresh();

        $this->assertEquals($oldStock - 1, $product->stock);
    }
}
