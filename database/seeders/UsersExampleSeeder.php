<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 10 usuarios de ejemplo
        DB::table('users')->insert([
            [
                'name' => 'John',
                'lastname' => 'Doe',
                'email' => 'johndoe@example.com',
                'password' => bcrypt('12345678'),
                'phone' => '1234567890',
                'province' => 'San José',
                'canton' => 'Central',
                'address' => 'Calle 1, San José',
                'birth_date' => Carbon::create('1990', '01', '01'),
                'user_type' => 'client',
                'average_rating' => 4.5,
                'rating_count' => 10,
                'blocked_for_review' => null,
                'profile_photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane',
                'lastname' => 'Smith',
                'email' => 'janesmith@example.com',
                'password' => bcrypt('12345678'),
                'phone' => '0987654321',
                'province' => 'Alajuela',
                'canton' => 'Central',
                'address' => 'Calle 2, Alajuela',
                'birth_date' => Carbon::create('1985', '06', '15'),
                'user_type' => 'chambero',
                'average_rating' => 4.0,
                'rating_count' => 5,
                'blocked_for_review' => null,
                'profile_photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carlos',
                'lastname' => 'Lopez',
                'email' => 'carloslopez@example.com',
                'password' => bcrypt('12345678'),
                'phone' => '2345678901',
                'province' => 'Heredia',
                'canton' => 'Barva',
                'address' => 'Calle 3, Heredia',
                'birth_date' => Carbon::create('1992', '08', '22'),
                'user_type' => 'client',
                'average_rating' => 4.2,
                'rating_count' => 8,
                'blocked_for_review' => null,
                'profile_photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana',
                'lastname' => 'Garcia',
                'email' => 'anagarcia@example.com',
                'password' => bcrypt('12345678'),
                'phone' => '3456789012',
                'province' => 'Cartago',
                'canton' => 'Central',
                'address' => 'Calle 4, Cartago',
                'birth_date' => Carbon::create('1988', '12', '04'),
                'user_type' => 'chambero',
                'average_rating' => 3.9,
                'rating_count' => 6,
                'blocked_for_review' => null,
                'profile_photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Luis',
                'lastname' => 'Perez',
                'email' => 'luisperez@example.com',
                'password' => bcrypt('12345678'),
                'phone' => '4567890123',
                'province' => 'San José',
                'canton' => 'Escazú',
                'address' => 'Calle 5, Escazú',
                'birth_date' => Carbon::create('1982', '07', '13'),
                'user_type' => 'client',
                'average_rating' => 4.7,
                'rating_count' => 12,
                'blocked_for_review' => null,
                'profile_photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'María',
                'lastname' => 'Rodríguez',
                'email' => 'mariarodriguez@example.com',
                'password' => bcrypt('12345678'),
                'phone' => '5678901234',
                'province' => 'Alajuela',
                'canton' => 'San Ramón',
                'address' => 'Calle 6, Alajuela',
                'birth_date' => Carbon::create('1995', '09', '05'),
                'user_type' => 'chambero',
                'average_rating' => 4.3,
                'rating_count' => 7,
                'blocked_for_review' => null,
                'profile_photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'José',
                'lastname' => 'Vargas',
                'email' => 'josevargas@example.com',
                'password' => bcrypt('12345678'),
                'phone' => '6789012345',
                'province' => 'Puntarenas',
                'canton' => 'Central',
                'address' => 'Calle 7, Puntarenas',
                'birth_date' => Carbon::create('1983', '11', '18'),
                'user_type' => 'client',
                'average_rating' => 4.1,
                'rating_count' => 9,
                'blocked_for_review' => null,
                'profile_photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laura',
                'lastname' => 'Martínez',
                'email' => 'lauramartinez@example.com',
                'password' => bcrypt('12345678'),
                'phone' => '7890123456',
                'province' => 'Guanacaste',
                'canton' => 'Liberia',
                'address' => 'Calle 8, Liberia',
                'birth_date' => Carbon::create('1991', '04', '25'),
                'user_type' => 'chambero',
                'average_rating' => 3.8,
                'rating_count' => 4,
                'blocked_for_review' => null,
                'profile_photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pedro',
                'lastname' => 'Jiménez',
                'email' => 'pedrojimenez@example.com',
                'password' => bcrypt('12345678'),
                'phone' => '8901234567',
                'province' => 'Heredia',
                'canton' => 'San Rafael',
                'address' => 'Calle 9, Heredia',
                'birth_date' => Carbon::create('1993', '02', '10'),
                'user_type' => 'client',
                'average_rating' => 4.4,
                'rating_count' => 11,
                'blocked_for_review' => null,
                'profile_photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rosa',
                'lastname' => 'González',
                'email' => 'rosagonzalez@example.com',
                'password' => bcrypt('12345678'),
                'phone' => '9012345678',
                'province' => 'Cartago',
                'canton' => 'Turrialba',
                'address' => 'Calle 10, Cartago',
                'birth_date' => Carbon::create('1994', '03', '14'),
                'user_type' => 'chambero',
                'average_rating' => 3.6,
                'rating_count' => 3,
                'blocked_for_review' => null,
                'profile_photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
