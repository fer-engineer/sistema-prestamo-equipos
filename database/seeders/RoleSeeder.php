<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::updateOrCreate(
            ['nombre' => 'Administrador'],
            ['descripcion' => 'Tiene acceso a todas las funcionalidades del sistema.']
        );

        Rol::updateOrCreate(
            ['nombre' => 'Encargado'],
            ['descripcion' => 'Responsable de la gestión de préstamos y devoluciones de equipos.']
        );
    }
}
