<?php

namespace Database\Seeders;

use App\Models\Accessory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accessories = [
            ['name'  => 'Накит'],
            ['name'  => 'Ташни'],
            ['name'  => 'Горна облека'],
            ['name'  => 'Долна облека'],
            ['name'  => 'Чизми'],
        ];

        foreach ($accessories as $accessori) {
            Accessory::create($accessori);
        }
    }
}
