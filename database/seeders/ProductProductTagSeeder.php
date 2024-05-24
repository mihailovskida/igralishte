<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductProductTag;
use App\Models\ProductTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_id = Product::pluck('id')->toArray();
        $product_tag_id = ProductTag::pluck('id')->toArray();

        $data = [];

        for ($i = 0; $i < 15; $i++) {
            $data[] = [
                'product_id'         => $product_id[array_rand($product_id)],
                'product_tag_id'     => $product_tag_id[array_rand($product_tag_id)],
            ];
        }
        ProductProductTag::insert($data);
    }
}
