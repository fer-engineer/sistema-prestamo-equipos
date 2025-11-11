<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;

class EncargadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar id de estado 'Activo' para tipo 'Usuario'
        $estadoUsuarioId = Estado::where('nombre', 'Activo')->where('tipo_estado', 'Usuario')->value('id') ?? 1;

        DB::table('encargados')->insert([
            [
                'nombre' => 'Jorge',
                'apellido' => 'Diaz',
                'correo' => 'jorge.diaz@example.com',
                'telefono' => '45645645',
                'estado_id' => $estadoUsuarioId, // Activo (lookup dinámico)
                'user_id' => 3,
            ],
            [
                'nombre' => 'Sofia',
                'apellido' => 'Sanchez',
                'correo' => 'sofia.sanchez@example.com',
                'telefono' => '78978978',
                'estado_id' => $estadoUsuarioId, // Activo (lookup dinámico)
                'user_id' => 4,
            ],
        ]);
    }
}