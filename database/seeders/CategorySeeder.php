<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'test@gmail.com')->first();
        if (!$user) return;

        $categories = ['Electronics', 'Furniture', 'Clothing', 'Books', 'Home Decor'];
        
        foreach ($categories as $category) {
            Category::create([
                'user_id' => $user->id,
                'name' => $category
            ]);
        }
    }
}
