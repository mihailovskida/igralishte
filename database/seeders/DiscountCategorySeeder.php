<?php

namespace Database\Seeders;

use App\Models\DiscountCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name'  => 'Висок'],
            ['name'  => 'Средно'],
            ['name'  => 'Низок'],
        ];

        foreach ($categories as $category) {
            DiscountCategory::create($category);
        }
    }
}
