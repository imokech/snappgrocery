<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected $productService;

    public function setUp(): void
    {
        parent::setUp();

        $this->productService = app()->make(ProductService::class);
    }

    public function testCreatingProduct_canStoreNewProduct_expectedSuccessfulMessage()
    {
        $product = Product::factory()->create();

        $response = $this->post('/api/v1/products/create', $product->toArray());

        $response->assertStatus(201)
            ->assertSee("Product {$product->product_title} is created successfully");

        $this->assertDatabaseHas('products', $product);
    }

    public function testFindProduct_CanFindProductById_expectedProduct()
    {
        $product = Product::factory()->create();

        $response = $this->get("/api/v1/products/{$product->id}");

        $response->assertStatus(200)->assertSee($product->product_title);
    }

    /**
    public function testFindProductById_canFindProductById_expectJsonResource()
    {
        $result = $this->productService->getProductById(55);

        $this->assertEquals(JsonResource::make([
            'status' => 'Success',
            'data' => []
        ]), $result);

        $result = $this->productService->getProductById(PHP_INT_MAX);
        $this->assertEquals('Product not found with ID: '.PHP_INT_MAX, $result);
    }
    */

    public function testGetProductsByVendorId_expectedProducts()
    {
        $vendor = Vendor::factory()->create();
        $product = Product::factory()->withSpecificVendor($vendor->id)->create();
        $response = $this->get("/api/v1/products/{$vendor->id}/vendor");

        $response->assertStatus(200)->assertSee($product->product_title);

        $this->assertDatabaseHas('products', $product->toArray());
    }
}
