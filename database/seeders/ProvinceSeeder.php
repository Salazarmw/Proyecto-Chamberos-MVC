<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            'San José',
            'Alajuela',
            'Cartago',
            'Guanacaste',
            'Heredia',
            'Puntarenas',
            'Limón'
        ];

        foreach ($provinces as $province) {
            Province::create(['name' => $province]);
        }
    }
}
