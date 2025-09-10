<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Apple',
            'Samsung',
            'Sony',
            'Nike',
            'Adidas',
            'Puma',
            'LG',
            'Dell',
            'HP',
            'Lenovo',
        ];

        foreach ($brands as $index => $name) {
            DB::table('brands')->insert([
                'id' => Str::uuid(),
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => "Products from the brand $name.",
                'image' => "https://picsum.photos/400/300?random=" . ($index + 20),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
