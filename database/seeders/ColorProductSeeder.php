<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $colors = Color::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        $data = [];

        foreach ($products as $product) {
            $numColors = rand(2, 3);
            shuffle($colors);
            $selectedColors = array_slice($colors, 0, $numColors);
            foreach ($selectedColors as $color) {
                $data[] = [
                    'color_id' => $color,
                    'product_id' => $product,
                ];
            }
        }

        ColorProduct::insert($data);
    }
}
