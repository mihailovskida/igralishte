<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name'  => 'Чизми'],
            ['name'  => 'Шорцеви'],
            ['name'  => 'Блузи'],
            ['name'  => 'Тренерки'],
            ['name'  => 'Дуксери'],
            ['name'  => 'Палта и јакни'],
            ['name'  => 'Фустани'],
            ['name'  => 'Долна Облека'],
            ['name'  => 'Панталони'],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
