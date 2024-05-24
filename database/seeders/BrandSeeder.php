<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Image;
use App\Models\TagBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $brands = [
            'Pinc Partywear',
            'Factory Girl',
            'Main Days',
            'Нежно',
            'Ред',
            'Наш Fraeil',
            'Urma',
            'Gatta',
            'Candle Nest'
        ];

        foreach ($brands as $brandName) {
            $brand = Brand::create([
                'name' => $brandName,
                'description' => fake()->text(100),
            ]);

            for ($j = 0; $j < 4; $j++) {
                Image::create([
                    'path' => fake()->imageUrl(),
                    'imageable_id' => $brand->id,
                    'imageable_type' => Brand::class
                ]);
            }
        }
    }
}
