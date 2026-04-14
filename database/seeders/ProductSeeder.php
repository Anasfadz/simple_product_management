<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = \App\Models\Category::all();
        if ($categories->isEmpty()) return;
        foreach ($categories as $category) {
            for ($i = 1; $i <= 5; $i++) {
                \App\Models\Product::create([
                    'category_id' => $category->id,
                    'name' => $category->name . ' Product ' . $i,
                    'quantity' => rand(1, 100),
                ]);
            }
        }
    }
}
