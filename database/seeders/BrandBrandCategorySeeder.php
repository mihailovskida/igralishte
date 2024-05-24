<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandBrandCategory;
use App\Models\BrandCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandBrandCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand_id = Brand::pluck('id')->toArray();
        $category_id = BrandCategory::pluck('id')->toArray();

        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'brand_id'      => $brand_id[array_rand($brand_id)],
                'category_id'   => $category_id[array_rand($category_id)],
            ];
        }

        BrandBrandCategory::insert($data);
    }
}
