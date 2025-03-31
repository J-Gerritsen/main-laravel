<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  ./vendor/bin/sail artisan db:seed --class=CategorySeeder
     */
    public function run(): void
    {
        Category::factory()->count(8)->create();
    }
}
