<?php

namespace App\Http\Controllers;

use App\Models\DetalleEstudiante;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DetalleEstudianteController extends Controller
{
    public function index()
    {
        $detalles = DetalleEstudiante::with('persona')->paginate(10);
        return view('detalles-estudiante.index', compact('detalles'));
    }

    public function create()
    {
        $personas = Persona::getAvailableEstudiantes();
        return view('detalles-estudiante.create', compact('personas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nie' => 'required|string|unique:detalle_estudiante,nie',
            'persona_id' => 'required|exists:personas,id|unique:detalle_estudiante,persona_id',
        ]);

        DetalleEstudiante::create($validated);

        return redirect()->route('detalles-estudiante.index')->with('success', 'Detalle de estudiante creado exitosamente.');
    }

    public function show(DetalleEstudiante $detalle_estudiante)
    {
        $detalle_estudiante->load('persona');
        return view('detalles-estudiante.show', compact('detalle_estudiante'));
    }

    public function edit(DetalleEstudiante $detalle_estudiante)
    {
        $personas = Persona::whereHas('tipoUsuario', function ($query) {
            $query->where('nombre', 'Estudiante');
        })->where(function ($query) use ($detalle_estudiante) {
            $query->whereDoesntHave('detalleEstudiante')
                  ->orWhere('id', $detalle_estudiante->persona_id);
        })->get();

        return view('detalles-estudiante.edit', compact('detalle_estudiante', 'personas'));
    }

    public function update(Request $request, DetalleEstudiante $detalle_estudiante)
    {
        $validated = $request->validate([
            'nie' => ['required', 'string', Rule::unique('detalle_estudiante')->ignore($detalle_estudiante->id)],
            'persona_id' => ['required', 'exists:personas,id', Rule::unique('detalle_estudiante')->ignore($detalle_estudiante->id)],
        ]);

        $detalle_estudiante->update($validated);

        return redirect()->route('detalles-estudiante.index')->with('success', 'Detalle de estudiante actualizado exitosamente.');
    }

    public function destroy(Request $request, DetalleEstudiante $detalle_estudiante)
    {
        // Cargar la relación 'persona' si no está ya cargada
        $detalle_estudiante->load('persona');

        // Verificar si la persona asociada tiene préstamos
        if ($detalle_estudiante->persona && $detalle_estudiante->persona->prestamos()->exists()) {
            $message = 'No se puede eliminar el detalle del estudiante porque la persona asociada tiene préstamos registrados.';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 409); // 409 Conflict
            }
            return redirect()->route('detalles-estudiante.index')->with('error', $message);
        }

        try {
            $detalle_estudiante->delete();

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Detalle de estudiante eliminado exitosamente.']);
            }

            return redirect()->route('detalles-estudiante.index')->with('success', 'Detalle de estudiante eliminado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar detalle de estudiante: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Error al eliminar el detalle de estudiante.'], 500);
            }

            return redirect()->route('detalles-estudiante.index')->with('error', 'Error al eliminar el detalle de estudiante.');
        }
    }
}
