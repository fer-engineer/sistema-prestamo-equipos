<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            // Estados para Equipos
            ['nombre' => 'Disponible', 'tipo_estado' => 'Equipo'],
            ['nombre' => 'En préstamo', 'tipo_estado' => 'Equipo'],
            ['nombre' => 'En mantenimiento', 'tipo_estado' => 'Equipo'],
            ['nombre' => 'De baja', 'tipo_estado' => 'Equipo'],

            // Estados para Personas (y Encargados)
            ['nombre' => 'Activo', 'tipo_estado' => 'Usuario'],
            ['nombre' => 'Inactivo', 'tipo_estado' => 'Usuario'],
            ['nombre' => 'Suspendido', 'tipo_estado' => 'Usuario'],

            // Estados para Préstamos
            ['nombre' => 'Pendiente', 'tipo_estado' => 'Prestamo'],
            ['nombre' => 'Aprobado', 'tipo_estado' => 'Prestamo'],
            ['nombre' => 'En curso', 'tipo_estado' => 'Prestamo'],
            ['nombre' => 'Devuelto', 'tipo_estado' => 'Prestamo'],
            ['nombre' => 'Rechazado', 'tipo_estado' => 'Prestamo'],

            // Estados Generales
            ['nombre' => 'Activo', 'tipo_estado' => 'General'],
            ['nombre' => 'Inactivo', 'tipo_estado' => 'General'],
        ];

        foreach ($estados as $estado) {
            Estado::updateOrCreate(
                ['nombre' => $estado['nombre'], 'tipo_estado' => $estado['tipo_estado']],
                [
                    'nombre' => $estado['nombre'],
                    'tipo_estado' => $estado['tipo_estado'],
                    'descripcion' => 'Estado ' . $estado['nombre'] . ' para ' . $estado['tipo_estado'],
                ]
            );
        }
    }
}