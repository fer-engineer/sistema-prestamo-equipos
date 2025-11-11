<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;
use Carbon\Carbon;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $estadoDisponibleId = Estado::where('nombre', 'Disponible')->where('tipo_estado', 'Equipo')->value('id') ?? 1;

    DB::table('equipos')->insert([
            [
                'marca_id' => 1, // Epson
                'modelo' => 'PowerLite 1795F',
                'descripcion' => 'Proyector 3LCD, Full HD, 3200 lúmenes, inalámbrico.',
                'estado_id' => $estadoDisponibleId, // Disponible (lookup dinámico)
                'fecha_adquisicion' => Carbon::now()->subMonths(6),
            ],
            [
                'marca_id' => 2, // BenQ
                'modelo' => 'TK850',
                'descripcion' => 'Proyector 4K UHD, 3000 lúmenes, HDR-PRO, ideal para cine en casa.',
                'estado_id' => $estadoDisponibleId, // Disponible (lookup dinámico)
                'fecha_adquisicion' => Carbon::now()->subMonths(3),
            ],
            [
                'marca_id' => 3, // Sony
                'modelo' => 'VPL-VW295ES',
                'descripcion' => 'Proyector 4K SXRD, 1500 lúmenes, HDR, para cine en casa de alta gama.',
                'estado_id' => $estadoDisponibleId, // Disponible (lookup dinámico)
                'fecha_adquisicion' => Carbon::now()->subYear(1),
            ],
            [
                'marca_id' => 5, // ViewSonic
                'modelo' => 'PX747-4K',
                'descripcion' => 'Proyector 4K UHD, 3500 lúmenes, alta luminosidad para ambientes iluminados.',
                'estado_id' => $estadoDisponibleId, // Disponible (lookup dinámico)
                'fecha_adquisicion' => Carbon::now()->subMonths(2),
            ],
            [
                'marca_id' => 4, // Optoma
                'modelo' => 'HD146X',
                'descripcion' => 'Proyector Full HD, 3600 lúmenes, alto rendimiento para juegos y películas.',
                'estado_id' => $estadoDisponibleId, // Disponible (lookup dinámico)
                'fecha_adquisicion' => Carbon::now()->subMonths(8),
            ],
             [
                'marca_id' => 2, // BenQ
                'modelo' => 'HT2050A',
                'descripcion' => 'Proyector 1080p, 2200 lúmenes, 96% Rec.709 para colores cinematográficos.',
                'estado_id' => $estadoDisponibleId, // Disponible (lookup dinámico)
                'fecha_adquisicion' => Carbon::now()->subMonths(5),
            ],
        ]);
    }
}
