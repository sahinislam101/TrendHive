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
            $table->uuid('id')->primary();
            $table->string('name'); // product name
            $table->string('slug')->unique(); // SEO-friendly URL
            $table->text('description')->nullable(); // product details
            $table->text('small_description')->nullable();
            // price
            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2)->nullable();

            // Stock
            $table->unsignedInteger('stock')->default(0);
            $table->string('sku')->nullable(); // product code

            // product item
            $table->boolean('flash_sales')->default(false);
            $table->boolean('best_sell')->default(false);

            // Relations
            $table->uuid('category_id')->nullable();
            $table->uuid('brand_id')->nullable();

            // Main image 
            $table->string('image')->nullable();

            // Status
            $table->boolean('status')->default(false);

            $table->timestamps();

            // Indexes for better query performance
            $table->index(['category_id', 'brand_id']);
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
