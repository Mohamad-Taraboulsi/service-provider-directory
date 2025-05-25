<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Provider;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the Category and Provider tables.
     */
    public function run(): void
    {
        $categories = Category::factory()->count(5)->create();

        Provider::factory()
            ->count(30)
            ->create([
                'category_id' => fn () => $categories->random()->id,
            ]);
    }
}
