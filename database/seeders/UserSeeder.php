<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asumimos que el Rol 'Administrador' tiene id=1 y 'Encargado' tiene id=2
        // Y que las personas con id 6, 7 y 8 son docentes.

        DB::table('users')->insert([
            // Usuario Administrador
            [
                'name' => 'Marta Lopez', // Corresponde a la persona con id=6
                'email' => 'marta.lopez@example.com',
                'password' => Hash::make('password'),
                'role_id' => 1, // Rol de Administrador
                'email_verified_at' => now(),
            ],
            // Usuarios Encargados
            [
                'name' => 'Jorge Diaz', // Corresponde a la persona con id=7
                'email' => 'jorge.diaz@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2, // Rol de Encargado
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sofia Sanchez', // Corresponde a la persona con id=8
                'email' => 'sofia.sanchez@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2, // Rol de Encargado
                'email_verified_at' => now(),
            ],
        ]);
    }
}