<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Marca;
use App\Models\Estado;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Acotejamiento de la tabla
            $table->id(); // clave primaria de la tabla
            $table->foreignIdFor(Marca::class)->constrained();
            $table->string('modelo');
            $table->text('descripcion');
            $table->foreignIdFor(Estado::class)->constrained();
            $table->date('fecha_adquisicion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};