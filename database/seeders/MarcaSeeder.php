<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marcas')->insert([
            ['nombre' => 'Epson', 'descripcion' => 'Seiko Epson Corporation, fabricante japonés de proyectores y equipos de imagen.'],
            ['nombre' => 'BenQ', 'descripcion' => 'BenQ Corporation, empresa taiwanesa de dispositivos digitales y proyectores.'],
            ['nombre' => 'Sony', 'descripcion' => 'Sony Corporation, conglomerado multinacional japonés, fabricante de electrónica y proyectores.'],
            ['nombre' => 'Optoma', 'descripcion' => 'Optoma Corporation, fabricante de proyectores para cine en casa, educación y negocios.'],
            ['nombre' => 'ViewSonic', 'descripcion' => 'ViewSonic Corporation, proveedor de productos de visualización, incluyendo proyectores.'],
            ['nombre' => 'LG', 'descripcion' => 'LG Electronics, empresa surcoreana, fabricante de una amplia gama de productos electrónicos.'],
            ['nombre' => 'Acer', 'descripcion' => 'Acer Inc., corporación multinacional taiwanesa de hardware y electrónica.'],
            ['nombre' => 'Panasonic', 'descripcion' => 'Panasonic Corporation, multinacional japonesa de electrónica.'],
            ['nombre' => 'Canon', 'descripcion' => 'Canon Inc., multinacional japonesa especializada en productos de imagen y ópticos.'],
            ['nombre' => 'Hitachi', 'descripcion' => 'Hitachi, Ltd., conglomerado multinacional japonés de alta tecnología.'],
        ]);
    }
}
