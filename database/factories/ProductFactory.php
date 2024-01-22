<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vendor = Vendor::factory()->create();
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        $name = Faker::word();

        return [
            'vendor_id' => $vendor->id,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'title_fa' => $name,
            'title_en' => $this->faker->name,
            'product_title' => $name,
            'description' => Faker::paragraph(),
            'price' => $this->faker->numberBetween(1000, 150000),
            'rating' => $this->faker->randomFloat(1, 0, 5),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
