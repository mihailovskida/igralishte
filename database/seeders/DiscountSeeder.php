<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\DiscountCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_id = DiscountCategory::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $data = [
                'code'                  => fake()->numberBetween(100, 200),
                'amount'                => fake()->numberBetween(5, 30),
                'is_active'             => fake()->numberBetween(0, 1),
                'discount_category_id'  => fake()->randomElement($category_id)
            ];
            Discount::create($data);
        }
    }
}
