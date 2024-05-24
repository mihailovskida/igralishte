<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandBrandTag;
use App\Models\BrandTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandBrandTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand_id = Brand::pluck('id')->toArray();
        $brand_tag_id = BrandTag::pluck('id')->toArray();

        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'brand_id'     => $brand_id[array_rand($brand_id)],
                'brand_tag_id' => $brand_tag_id[array_rand($brand_tag_id)],
            ];
        }

        BrandBrandTag::insert($data);
    }
}
