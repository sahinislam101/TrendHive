<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Fashion',
            'Home & Kitchen',
            'Beauty & Personal Care',
            'Sports & Outdoors',
            'Books',
            'Toys & Games',
            'Groceries',
            'Health & Wellness',
            'Automotive',
        ];

        foreach ($categories as $index => $name) {
            DB::table('categories')->insert([
                'id' => Str::uuid(),
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => "This is the $name category with a variety of products.",
                'image' => "https://picsum.photos/400/300?random=" . ($index + 1),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
