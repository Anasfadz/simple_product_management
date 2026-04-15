<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'test@gmail.com')->first();
        if (!$user) return;

        $categories = Category::where('user_id', $user->id)->get();
        
        $pics = [
            'Electronics' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?q=80&w=500&auto=format&fit=crop',
            'Furniture' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=500&auto=format&fit=crop',
            'Clothing' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=500&auto=format&fit=crop',
            'Books' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?q=80&w=500&auto=format&fit=crop',
            'Home Decor' => 'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=500&auto=format&fit=crop',
        ];

        foreach ($categories as $category) {
            for ($i = 1; $i <= 4; $i++) {
                Product::create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'name' => $category->name . ' - Model ' . $i,
                    'quantity' => rand(2, 50),
                    'price' => rand(15, 2500),
                    'image_url' => $pics[$category->name] ?? null,
                ]);
            }
        }
    }
}
