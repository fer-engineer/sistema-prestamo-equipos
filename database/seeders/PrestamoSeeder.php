<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;
use Carbon\Carbon;

class PrestamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar ids de estados por nombre/tipo
        $estadoEnPrestamoId = Estado::where('nombre', 'En préstamo')->where('tipo_estado', 'Prestamo')->value('id')
            ?? Estado::where('nombre', 'En Préstamo')->where('tipo_estado', 'Prestamo')->value('id')
            ?? 2;
        $estadoDevueltoId = Estado::where('nombre', 'Devuelto')->where('tipo_estado', 'Prestamo')->value('id') ?? 3;

        DB::table('prestamos')->insert([
            // Préstamo 1: Activo, por Encargado 1 a Persona 1
            [
                'equipo_id' => 1,
                'encargado_id' => 1,
                'persona_id' => 1, // Juan Perez (Estudiante)
                'fecha_prestamo' => Carbon::now()->subDays(10),
                'fecha_devolucion' => null,
                'estado_id' => $estadoEnPrestamoId, // En Préstamo (lookup dinámico)
                'observaciones' => 'El estudiante se lleva el cargador.',
            ],
            // Préstamo 2: Devuelto, por Encargado 2 a Persona 6
            [
                'equipo_id' => 2,
                'encargado_id' => 2,
                'persona_id' => 6, // Marta Lopez (Docente)
                'fecha_prestamo' => Carbon::now()->subDays(20),
                'fecha_devolucion' => Carbon::now()->subDays(15),
                'estado_id' => $estadoDevueltoId, // Devuelto (lookup dinámico)
                'observaciones' => 'Devuelto en buenas condiciones.',
            ],
            // Préstamo 3: Activo, por Encargado 1 a Persona 2
            [
                'equipo_id' => 3,
                'encargado_id' => 1,
                'persona_id' => 2, // Maria Gomez (Estudiante)
                'fecha_prestamo' => Carbon::now()->subDays(5),
                'fecha_devolucion' => null,
                'estado_id' => $estadoEnPrestamoId, // En Préstamo (lookup dinámico)
                'observaciones' => null,
            ],
            // Préstamo 4: Activo, por Encargado 2 a Persona 7
            [
                'equipo_id' => 4,
                'encargado_id' => 2,
                'persona_id' => 7, // Jorge Diaz (Docente)
                'fecha_prestamo' => Carbon::now()->subDays(2),
                'fecha_devolucion' => null,
                'estado_id' => $estadoEnPrestamoId, // En Préstamo (lookup dinámico)
                'observaciones' => 'Solicita proyector para presentación.',
            ],
            // Préstamo 5: Devuelto, por Encargado 1 a Persona 3
            [
                'equipo_id' => 5,
                'encargado_id' => 1,
                'persona_id' => 3, // Carlos Rodriguez (Estudiante)
                'fecha_prestamo' => Carbon::now()->subMonth(),
                'fecha_devolucion' => Carbon::now()->subMonth()->addDays(7),
                'estado_id' => $estadoDevueltoId, // Devuelto (lookup dinámico)
                'observaciones' => 'Se reporta un pequeño rayón en la carcasa.',
            ],
        ]);
    }
}