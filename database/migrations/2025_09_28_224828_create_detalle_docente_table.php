<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Persona;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_docente', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Acotejamiento de la tabla
            $table->id();
            $table->string('dui');
            $table->foreignIdFor(Persona::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_docente');
    }
};