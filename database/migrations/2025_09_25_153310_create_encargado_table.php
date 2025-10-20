<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Estado;
use App\Models\Rol;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('encargados', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Acotejamiento de la tabla
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo');
            $table->string('telefono');
            $table->foreignIdFor(Estado::class)->constrained();
            $table->foreignIdFor(Rol::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encargados');
    }
};