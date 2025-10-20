<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('encargados', function (Blueprint $table) {
            // Agregamos el campo para la llave foránea y la configuramos
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encargados', function (Blueprint $table) {
            // Eliminamos la llave foránea y la columna
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};