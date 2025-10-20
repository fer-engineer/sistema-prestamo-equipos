<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TipoUsuarioController extends Controller
{
    /**
     * Mostrar listado de tipos de usuario.
     */
    public function index()
    {
        $tipos_usuario = TipoUsuario::paginate(10);
        return view('tipos_usuario.index', compact('tipos_usuario'));
    }

    /**
     * Mostrar formulario para crear un nuevo tipo de usuario.
     */
    public function create()
    {
        return view('tipos_usuario.create');
    }

    /**
     * Almacenar un nuevo tipo de usuario.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:tipos_usuario|max:255',
            'descripcion' => 'required|string',
        ]);

        TipoUsuario::create($validated);

        return redirect()->route('tipos_usuario.index')
            ->with('success', 'Tipo de usuario creado correctamente.');
    }

    /**
     * Mostrar un tipo de usuario específico.
     */
    public function show(TipoUsuario $tipo_usuario)
    {
        return view('tipos_usuario.show', compact('tipo_usuario'));
    }

    /**
     * Mostrar formulario para editar un tipo de usuario.
     */
    public function edit(TipoUsuario $tipo_usuario)
    {
        return view('tipos_usuario.edit', compact('tipo_usuario'));
    }

    /**
     * Actualizar un tipo de usuario existente.
     */
    public function update(Request $request, TipoUsuario $tipo_usuario)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('tipos_usuario')->ignore($tipo_usuario->id),
            ],
            'descripcion' => 'required|string',
        ]);

        $tipo_usuario->update($validated);

        return redirect()->route('tipos_usuario.index')
            ->with('success', 'Tipo de usuario actualizado correctamente.');
    }

    /**
     * Eliminar un tipo de usuario.
     */
    public function destroy(Request $request, TipoUsuario $tipo_usuario)
    {
        // Opcional: verifica si está asignado a personas
        if (method_exists($tipo_usuario, 'personas') && $tipo_usuario->personas()->exists()) {
            $message = 'No se puede eliminar el tipo de usuario porque está asignado a una o más personas.';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return redirect()->route('tipos_usuario.index')->with('error', $message);
        }

        $tipo_usuario->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Tipo de usuario eliminado correctamente.']);
        }

        return redirect()->route('tipos_usuario.index')->with('success', 'Tipo de usuario eliminado correctamente.');
    }
}
