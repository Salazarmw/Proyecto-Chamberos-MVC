<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tags = [
            ['id' => 1, 'description' => 'Albañil'],
            ['id' => 2, 'description' => 'Plomero'],
            ['id' => 3, 'description' => 'Electricista'],
            ['id' => 4, 'description' => 'Carpintero'],
            ['id' => 5, 'description' => 'Pintor'],
            ['id' => 6, 'description' => 'Jardinero'],
            ['id' => 7, 'description' => 'Fontanero'],
            ['id' => 8, 'description' => 'Cerrajero'],
            ['id' => 9, 'description' => 'Gasfitero'],
            ['id' => 10, 'description' => 'Techador'],
            ['id' => 11, 'description' => 'Soldador'],
            ['id' => 12, 'description' => 'Limpiador de Ventanas'],
            ['id' => 13, 'description' => 'Guardia de Seguridad'],
            ['id' => 14, 'description' => 'Reparador de Electrodomésticos'],
            ['id' => 15, 'description' => 'Mudanza'],
            ['id' => 16, 'description' => 'Chofer'],
            ['id' => 17, 'description' => 'Reparador de Computadoras'],
            ['id' => 18, 'description' => 'Instalador de A/C'],
            ['id' => 19, 'description' => 'Fumigador'],
            ['id' => 20, 'description' => 'Mecánico de Autos'],
            ['id' => 21, 'description' => 'Limpieza de Alfombras'],
            ['id' => 22, 'description' => 'Instalador de TV por Cable'],
            ['id' => 23, 'description' => 'Peluquero'],
            ['id' => 24, 'description' => 'Manicurista'],
            ['id' => 25, 'description' => 'Masajista'],
            ['id' => 26, 'description' => 'Montador de Muebles'],
            ['id' => 27, 'description' => 'Paseador de Perros'],
            ['id' => 28, 'description' => 'Cuidador de Personas Mayores'],
            ['id' => 29, 'description' => 'Cocinero a Domicilio'],
            ['id' => 30, 'description' => 'Decorador de Interiores'],
        ];

        DB::table('tags')->insert($tags);
    }
}
