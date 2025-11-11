<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// Importar los nuevos seeders
use Database\Seeders\DetalleDocenteSeeder;
use Database\Seeders\DetalleEstudianteSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders base existentes
        $this->call(RoleSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(TipoUsuarioSeeder::class);

        // Lógica existente para crear un admin por defecto
        $adminRole = Rol::where('nombre', 'Administrador')->first();
        if ($adminRole) {
            User::firstOrCreate(
                ['email' => 'sistema@admin.com'],
                [
                    'name' => 'Administrador',
                    'password' => Hash::make('Admin1234._@'),
                    'role_id' => $adminRole->id,
                ]
            );
        }

        // --- Mis nuevos seeders ---
        // Los llamo en el orden correcto para manejar las dependencias
        $this->call([
            MarcaSeeder::class,
            UserSeeder::class,      // Crea usuarios de prueba (1 admin, 2 encargados)
            EncargadoSeeder::class, // Asocia los usuarios encargados
            EquipoSeeder::class,
            // --- AÑADIR SEEDERS DE DETALLES ---
            DetalleDocenteSeeder::class, // Crea 10 docentes con sus detalles
            DetalleEstudianteSeeder::class, // Crea 20 estudiantes con sus detalles
            PrestamoSeeder::class,
        ]);
    }
}
