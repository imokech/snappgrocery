<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->id('product_id');
            $table->foreignIdFor(Vendor::class);
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Brand::class);
            $table->tinyText('title_fa');
            $table->tinyText('title_en')->nullable();
            $table->text('description');
            $table->integer('price');
            $table->smallInteger('rating')->default(0);
            $table->bigInteger('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
