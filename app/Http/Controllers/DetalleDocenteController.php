<?php

namespace App\Http\Controllers;

use App\Models\DetalleDocente;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DetalleDocenteController extends Controller
{
    public function index()
    {
        $detalles = DetalleDocente::with('persona')->paginate(10);
        return view('detalles-docente.index', compact('detalles'));
    }

    public function create()
    {
        $personas = Persona::getAvailableDocentes();
        return view('detalles-docente.create', compact('personas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dui' => 'required|string|unique:detalle_docente,dui',
            'persona_id' => 'required|exists:personas,id|unique:detalle_docente,persona_id',
        ]);

        DetalleDocente::create($validated);

        return redirect()->route('detalles-docente.index')->with('success', 'Detalle de docente creado exitosamente.');
    }

    public function show(DetalleDocente $detalle_docente)
    {
        $detalle_docente->load('persona');
        return view('detalles-docente.show', compact('detalle_docente'));
    }

    public function edit(DetalleDocente $detalle_docente)
    {
        $personas = Persona::whereHas('tipoUsuario', function ($query) {
            $query->where('nombre', 'Docente');
        })->where(function ($query) use ($detalle_docente) {
            $query->whereDoesntHave('detalleDocente')
                ->orWhere('id', $detalle_docente->persona_id);
        })->get();
        
        return view('detalles-docente.edit', compact('detalle_docente', 'personas'));
    }

    public function update(Request $request, DetalleDocente $detalle_docente)
    {
        $validated = $request->validate([
            'dui' => ['required', 'string', Rule::unique('detalle_docente')->ignore($detalle_docente->id)],
            'persona_id' => ['required', 'exists:personas,id'],
        ]);

        $detalle_docente->update($validated);

        return redirect()->route('detalles-docente.index')->with('success', 'Detalle de docente actualizado exitosamente.');
    }

    public function destroy(Request $request, DetalleDocente $detalle_docente)
    {
        // Cargar la relación 'persona' si no está ya cargada
        $detalle_docente->load('persona');

        // Verificar si la persona asociada tiene préstamos
        if ($detalle_docente->persona && $detalle_docente->persona->prestamos()->exists()) {
            $message = 'No se puede eliminar el detalle del docente porque la persona asociada tiene préstamos registrados.';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 409); // 409 Conflict
            }
            return redirect()->route('detalles-docente.index')->with('error', $message);
        }

        try {
            $detalle_docente->delete();

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Detalle de docente eliminado exitosamente.']);
            }

            return redirect()->route('detalles-docente.index')->with('success', 'Detalle de docente eliminado exitosamente.');
        } catch (\Exception $e) {
            // Log::error('Error al eliminar detalle de docente: ' . $e->getMessage());

            $message = 'Ocurrió un error al intentar eliminar el detalle del docente.';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 500);
            }

            return redirect()->route('detalles-docente.index')->with('error', $message);
        }
    }
}
