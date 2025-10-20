<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\DetalleDocenteController;
use App\Http\Controllers\DetalleEstudianteController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ReporteController;



Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // Rutas para Admin y Encargado (Préstamos y Equipos)
    Route::middleware('can:operate-loans')->group(function () {
        Route::resource('equipos', EquipoController::class);
        Route::resource('prestamos', PrestamoController::class);

        // Ruta para Reportes
        Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
        Route::get('reportes/pdf', [ReporteController::class, 'pdf'])->name('reportes.pdf');
        Route::get('reportes/pdf/all', [ReporteController::class, 'pdfAll'])->name('reportes.pdf.all');
    });

    // Rutas solo para Administradores
    Route::middleware('can:manage-system')->group(function () {
        Route::resource('roles', RolController::class);
        Route::resource('marcas', MarcaController::class);
        Route::resource('estados', EstadoController::class);
        Route::resource('tipos_usuario', TipoUsuarioController::class)
            ->parameters(['tipos_usuario' => 'tipo_usuario']);
        Route::resource('personas', PersonaController::class);
        Route::resource('encargados', EncargadoController::class);
        Route::resource('detalles-docente', DetalleDocenteController::class)
            ->parameters(['detalles-docente' => 'detalle_docente']);
        Route::resource('detalles-estudiante', DetalleEstudianteController::class)
        ->parameters(['detalles-estudiante' => 'detalle_estudiante']);
    });
});

require __DIR__.'/auth.php';