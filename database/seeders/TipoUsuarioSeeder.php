<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos_usuario')->insert([
            ['nombre' => 'Docente', 'descripcion' => 'Usuario con permiso para solicitar y gestionar préstamos de proyectores.'],
            ['nombre' => 'Estudiante', 'descripcion' => 'Usuario que puede solicitar préstamos de proyectores para uso académico.'],
        ]);
    }
}
