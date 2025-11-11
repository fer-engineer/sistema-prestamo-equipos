<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $estadoUsuarioId = Estado::where('nombre', 'Activo')->where('tipo_estado', 'Usuario')->value('id') ?? 1;

    DB::table('personas')->insert([
            // 5 Estudiantes
            [
                'nombre' => 'Juan',
                'apellido' => 'Perez',
                'correo' => 'juan.perez@example.com',
                'telefono' => '12345678',
                'tipo_usuario_id' => 1, // Asumiendo 1 = Estudiante
                'estado_id' => $estadoUsuarioId, // Activo (lookup dinámico)
            ],
            [
                'nombre' => 'Maria',
                'apellido' => 'Gomez',
                'correo' => 'maria.gomez@example.com',
                'telefono' => '87654321',
                'tipo_usuario_id' => 1,
                'estado_id' => $estadoUsuarioId,
            ],
            [
                'nombre' => 'Carlos',
                'apellido' => 'Rodriguez',
                'correo' => 'carlos.rodriguez@example.com',
                'telefono' => '11223344',
                'tipo_usuario_id' => 1,
                'estado_id' => $estadoUsuarioId,
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'Martinez',
                'correo' => 'ana.martinez@example.com',
                'telefono' => '55667788',
                'tipo_usuario_id' => 1,
                'estado_id' => $estadoUsuarioId,
            ],
            [
                'nombre' => 'Luis',
                'apellido' => 'Hernandez',
                'correo' => 'luis.hernandez@example.com',
                'telefono' => '99887766',
                'tipo_usuario_id' => 1,
                'estado_id' => $estadoUsuarioId,
            ],
            // 5 Docentes
            [
                'nombre' => 'Marta',
                'apellido' => 'Lopez',
                'correo' => 'marta.lopez@example.com',
                'telefono' => '12312312',
                'tipo_usuario_id' => 2, // Asumiendo 2 = Docente
                'estado_id' => $estadoUsuarioId,
            ],
            [
                'nombre' => 'Jorge',
                'apellido' => 'Diaz',
                'correo' => 'jorge.diaz@example.com',
                'telefono' => '45645645',
                'tipo_usuario_id' => 2,
                'estado_id' => 1,
            ],
            [
                'nombre' => 'Sofia',
                'apellido' => 'Sanchez',
                'correo' => 'sofia.sanchez@example.com',
                'telefono' => '78978978',
                'tipo_usuario_id' => 2,
                'estado_id' => 1,
            ],
            [
                'nombre' => 'Ricardo',
                'apellido' => 'Ramirez',
                'correo' => 'ricardo.ramirez@example.com',
                'telefono' => '14725836',
                'tipo_usuario_id' => 2,
                'estado_id' => 1,
            ],
            [
                'nombre' => 'Elena',
                'apellido' => 'Flores',
                'correo' => 'elena.flores@example.com',
                'telefono' => '36925814',
                'tipo_usuario_id' => 2,
                'estado_id' => 1,
            ],
        ]);
    }
}