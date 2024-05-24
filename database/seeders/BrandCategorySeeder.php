<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name'  => 'Кратки'],
            ['name'  => 'Долги'],
            ['name'  => 'Лето'],
            ['name'  => 'Јакни'],
            ['name'  => 'Тренерки'],
        ];

        foreach ($categories as $category) {
            BrandCategory::create($category);
        }
    }
}
