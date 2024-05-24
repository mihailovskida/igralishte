<?php

namespace Database\Seeders;

use App\Models\ProductTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name'  => 'ново'],
            ['name'  => 'палта'],
            ['name'  => 'облека'],
            ['name'  => 'vintage'],
            ['name'  => 'trendy'],
        ];

        foreach ($tags as $tag) {
            ProductTag::create($tag);
        }
    }
}
