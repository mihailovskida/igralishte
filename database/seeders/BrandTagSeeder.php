<?php

namespace Database\Seeders;

use App\Models\BrandTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandTagSeeder extends Seeder
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
        ];

        foreach ($tags as $tag) {
            BrandTag::create($tag);
        }
    }
}
