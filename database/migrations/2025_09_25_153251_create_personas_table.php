<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TipoUsuario;
use App\Models\Estado;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Acotejamiento de la tabla
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo')->unique();
            $table->string('telefono');
            $table->foreignIdFor(TipoUsuario::class)->constrained();
            $table->foreignIdFor(Estado::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
