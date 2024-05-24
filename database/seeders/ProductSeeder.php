<?php

namespace Database\Seeders;

use App\Models\Accessory;
use App\Models\Brand;
use App\Models\Discount;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discount_id = Discount::pluck('id')->toArray();
        $brand_id = Brand::pluck('id')->toArray();
        $product_category_id = ProductCategory::pluck('id')->toArray();
        $accessory_id = Accessory::pluck('id')->toArray();

        for ($i = 0; $i < 15; $i++) {
            $product = Product::create([
                'name'                  => fake()->name(),
                'description'           => fake()->text(50),
                'price'                 => fake()->numberBetween(100, 500),
                'stock'                 => fake()->numberBetween(0, 15),
                'size_description'      => 'Ова парче е направено од материјал кој не се растега. Одговара на наведената величина.',
                'maintenance'           => 'Ова парче треба хемиски да се третира според инструкциите на етикетата.',
                'material'              => fake()->text(),
                'discount_id'           => fake()->randomElement($discount_id),
                'brand_id'              => fake()->randomElement($brand_id),
                'product_category_id'   => fake()->randomElement($product_category_id),
                'accessory_id'          => fake()->randomElement($accessory_id),
            ]);

            for ($j = 0; $j < 4; $j++) {
                Image::create([
                    'path'              => fake()->randomElement([
                        'https://img.freepik.com/free-photo/young-beautiful-smiling-female-trendy-summer-red-dress-sexy-carefree-woman-posing-near-blue-wall-studio-positive-model-having-fun-cheerful-happy-holding-her-heeled-shoes-hands_158538-25231.jpg',
                        'https://t3.ftcdn.net/jpg/03/26/77/12/360_F_326771205_9vwwoe2c4Lobu4IQVLfE2LFoUFZ7UgxU.jpg',
                        'https://t3.ftcdn.net/jpg/04/39/70/88/360_F_439708885_h8qkyB2ePt5V99lGOWewGLytIDupPI1x.jpg',
                        'https://st4.depositphotos.com/12985790/25316/i/450/depositphotos_253160930-stock-photo-beautiful-stylish-young-woman-colorful.jpg'
                    ]),
                    'imageable_id'      => $product->id,
                    'imageable_type'    => Product::class
                ]);
            }
        }
    }
}
