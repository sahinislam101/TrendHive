<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('sliders')->insert([
                'id' => Str::uuid(),
                'name' => "Promo Banner $i",
                'slug' => "slider-$i",
                'description' => "Special promotion slider $i",
                'image' => "https://picsum.photos/800/300?random=$i",
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
