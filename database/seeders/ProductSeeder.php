<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // সব category & brand বের করা
        $categories = Category::pluck('id')->toArray();
        $brands = Brand::pluck('id')->toArray();

        // ৩০টা product তৈরি
        for ($i = 1; $i <= 30; $i++) {
            $name = "Product $i";

            DB::table('products')->insert([
                'id' => Str::uuid(),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . $i,
                'description' => "This is the full description of $name with details about quality and features.",
                'small_description' => "Short details about $name.",

                // price
                'original_price' => rand(1000, 5000),
                'selling_price' => rand(500, 4000),

                // stock & sku
                'stock' => rand(10, 100),
                'sku' => 'SKU-' . strtoupper(Str::random(6)),

                // flags
                'flash_sales' => (bool)rand(0, 1),
                'best_sell' => (bool)rand(0, 1),

                // relation
                'category_id' => $categories[array_rand($categories)],
                'brand_id' => $brands[array_rand($brands)],

                // image
                'image' => "https://picsum.photos/400/400?random=$i",

                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
