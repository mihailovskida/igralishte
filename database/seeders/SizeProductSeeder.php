<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use App\Models\SizeProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $sizes = Size::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        $data = [];

        foreach ($products as $product) {
            $numSizes = rand(1, 3);
            shuffle($sizes);
            $selectedSizes = array_slice($sizes, 0, $numSizes);
            foreach ($selectedSizes as $size) {
                $data[] = [
                    'size_id' => $size,
                    'product_id' => $product,
                ];
            }
        }

        SizeProduct::insert($data);
    }
}
