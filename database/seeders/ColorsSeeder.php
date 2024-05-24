<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Colors;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name'     => substr(md5(rand()), 0, 6),
            ];
        }
        Color::insert($data);
    }
}
