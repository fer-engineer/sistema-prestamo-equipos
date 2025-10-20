<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Equipo;
use App\Models\Encargado;
use App\Models\Persona;
use App\Models\Estado;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Acotejamiento de la tabla
            $table->id();
            $table->foreignIdFor(Equipo::class)->constrained();
            $table->foreignIdFor(Encargado::class)->constrained();
            $table->foreignIdFor(Persona::class)->constrained();
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion')->nullable();
            $table->foreignIdFor(Estado::class)->constrained();
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
