<?php

namespace Database\Seeders;

use App\Models\Canton;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CantonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cantons by province
        $cantons = [
            1 => [ // San José
                'San José',
                'Escazú',
                'Desamparados',
                'Puriscal',
                'Turrubares',
                'Mora',
                'Goicoechea',
                'Santa Ana',
                'Alajuelita',
                'Vázquez de Coronado',
                'Acosta',
                'Tibás',
                'Moravia',
                'Montes de Oca',
                'Curridabat',
                'Pavas',
                'La Unión',
                'San Vicente',
            ],
            2 => [ // Alajuela
                'Alajuela',
                'San Ramón',
                'Grecia',
                'Naranjo',
                'Palmares',
                'Atenas',
                'Sarchí',
                'Valverde Vega',
                'Upala',
                'Los Chiles',
                'Río Cuarto',
                'San Carlos',
                'Zarcero',
                'Cañas',
                'Bagaces',
                'Tilarán',
                'La Fortuna',
            ],
            3 => [ // Cartago
                'Cartago',
                'El Guarco',
                'Paraíso',
                'La Unión',
                'Jiménez',
                'Turrialba',
                'Oreamuno',
                'Alvarado',
                'Cervantes',
            ],
            4 => [ // Guanacaste
                'Liberia',
                'Nicoya',
                'Santa Cruz',
                'Bagaces',
                'Carrillo',
                'Cañas',
                'Tilarán',
                'Guanacaste',
                'La Cruz',
                'Hojancha',
            ],
            5 => [ // Heredia
                'Heredia',
                'Barva',
                'Santo Domingo',
                'Santa Bárbara',
                'San Rafael',
                'San Isidro',
                'Belén',
                'Flores',
                'San Pablo',
            ],
            6 => [ // Puntarenas
                'Puntarenas',
                'Esparza',
                'Buenos Aires',
                'Montes de Oro',
                'Osa',
                'Quepos',
                'Coto Brus',
                'Corredores',
                'Garabito',
                'Pérez Zeledón',
                'Turrubares',
            ],
            7 => [ // Limón
                'Limón',
                'Guácimo',
                'Siquirres',
                'Talamanca',
                'Matina',
                'Pococí',
                'Los Chiles',
                'Siquirres',
                'Cahuita',
            ],
        ];

        // Insertar los cantones en la base de datos
        foreach ($cantons as $provinceId => $names) {
            foreach ($names as $name) {
                Canton::create(['name' => $name, 'province_id' => $provinceId]);
            }
        }
    }
}
