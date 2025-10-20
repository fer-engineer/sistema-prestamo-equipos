<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Rol;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('encargados', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['rol_id']);
            // Then drop the column
            $table->dropColumn('rol_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encargados', function (Blueprint $table) {
            // Add the column and constraint back
            $table->foreignIdFor(Rol::class)->constrained();
        });
    }
};