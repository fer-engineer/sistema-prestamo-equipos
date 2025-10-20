<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = Estado::paginate(10);
        return view('estados.index', compact('estados'));
    }

    public function create()
    {
        return view('estados.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:estados|max:255',
            'descripcion' => 'required|string',
            'tipo_estado' => 'required|string|max:255',
        ]);

        Estado::create($validated);

        return redirect()->route('estados.index')
            ->with('success', 'Estado creado exitosamente.');
    }

    public function show(Estado $estado)
    {
        return view('estados.show', compact('estado'));
    }

    public function edit(Estado $estado)
    {
        return view('estados.edit', compact('estado'));
    }

    public function update(Request $request, Estado $estado)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('estados')->ignore($estado->id),
            ],
            'descripcion' => 'required|string',
            'tipo_estado' => 'required|string|max:255',
        ]);

        $estado->update($validated);

        return redirect()->route('estados.index')
            ->with('success', 'Estado actualizado exitosamente.');
    }

    public function destroy(Request $request, Estado $estado)
    {
        // Verificar si el estado está en uso en alguna de las tablas relacionadas
        if ($estado->personas()->exists() || $estado->encargados()->exists() || $estado->equipos()->exists() || $estado->prestamos()->exists()) {
            $message = 'No se puede eliminar el estado porque está actualmente en uso.';

            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }

            return redirect()->route('estados.index')->with('error', $message);
        }

        $estado->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Estado eliminado correctamente.']);
        }

        return redirect()->route('estados.index')
            ->with('success', 'Estado eliminado correctamente.');
    }
}