<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ColorProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UsersSeeder::class,
            AccessoriesSeeder::class,
            ProductCategorySeeder::class,
            DiscountCategorySeeder::class,
            DiscountSeeder::class,
            BrandSeeder::class,
            BrandCategorySeeder::class,
            BrandTagSeeder::class,
            BrandBrandTagSeeder::class,
            BrandBrandTagSeeder::class,
            ProductTagSeeder::class,
            ProductSeeder::class,
            ProductProductTagSeeder::class,
            ColorsSeeder::class,
            ColorProductSeeder::class,
            SizeSeeder::class,
            SizeProductSeeder::class,
        ]);
    }
}
