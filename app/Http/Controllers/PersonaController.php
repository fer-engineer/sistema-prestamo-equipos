<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\TipoUsuario;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::with(['tipoUsuario', 'estado'])->paginate(10);
        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        $tiposUsuario = TipoUsuario::all();
        $estados = Estado::where('tipo_estado', 'Usuario')->get();
        return view('personas.create', compact('tiposUsuario', 'estados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:personas,correo',
            'telefono' => 'required|string|max:15',
            'tipo_usuario_id' => 'required|exists:tipos_usuario,id',
            'estado_id' => 'required|exists:estados,id',
        ]);

        Persona::create($validated);

        return redirect()->route('personas.index')->with('success', 'Persona creada exitosamente.');
    }

    public function show(Persona $persona)
    {
        $persona->load(['tipoUsuario', 'estado', 'detalleDocente', 'detalleEstudiante']);
        return view('personas.show', compact('persona'));
    }

    public function edit(Persona $persona)
    {
        $tiposUsuario = TipoUsuario::all();
        $estados = Estado::where('tipo_estado', 'Usuario')->get();
        return view('personas.edit', compact('persona', 'tiposUsuario', 'estados'));
    }

    public function update(Request $request, Persona $persona)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => ['required', 'email', Rule::unique('personas')->ignore($persona->id)],
            'telefono' => 'required|string|max:15',
            'tipo_usuario_id' => 'required|exists:tipos_usuario,id',
            'estado_id' => 'required|exists:estados,id',
        ]);

        $persona->update($validated);

        return redirect()->route('personas.index')->with('success', 'Persona actualizada exitosamente.');
    }

    public function destroy(Request $request, Persona $persona)
    {
        try {
            // No permitir eliminar si tiene préstamos asociados
            if ($persona->prestamos()->exists()) {
                $message = 'No se puede eliminar la persona porque tiene préstamos asociados.';
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $message], 409); // 409 Conflict
                }
                return redirect()->route('personas.index')->with('error', $message);
            }

            // Eliminar detalles relacionados (si existen)
            $persona->detalleDocente()?->delete();
            $persona->detalleEstudiante()?->delete();

            // Eliminar la persona
            $persona->delete();

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Persona eliminada exitosamente.']);
            }

            return redirect()->route('personas.index')->with('success', 'Persona eliminada exitosamente.');

        } catch (\Exception $e) {
            Log::error('Error al eliminar persona: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Error al eliminar la persona.'], 500);
            }

            return redirect()->route('personas.index')->with('error', 'Error al eliminar la persona.');
        }
    }

}