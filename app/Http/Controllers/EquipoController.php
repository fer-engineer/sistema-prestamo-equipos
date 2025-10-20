<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::with(['marca', 'estado'])->paginate(10);
        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        $marcas = Marca::all();
        $estados = Estado::where('tipo_estado', 'Equipo')->get();
        return view('equipos.create', compact('marcas', 'estados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'marca_id' => 'required|exists:marcas,id',
            'modelo' => [
                'required',
                'string',
                'max:255',
                Rule::unique('equipos')->where(function ($query) use ($request) {
                    return $query->where('marca_id', $request->marca_id);
                }),
            ],
            'descripcion' => 'required|string|max:1000',
            'estado_id' => 'required|exists:estados,id',
            'fecha_adquisicion' => 'required|date',
        ]);

        Equipo::create($validated);

        return redirect()->route('equipos.index')->with('success', 'Equipo creado exitosamente.');
    }

    public function show(Equipo $equipo)
    {
        $equipo->load(['marca', 'estado']);
        return view('equipos.show', compact('equipo'));
    }

    public function edit(Equipo $equipo)
    {
        $marcas = Marca::all();
        $estados = Estado::where('tipo_estado', 'Equipo')->get();
        return view('equipos.edit', compact('equipo', 'marcas', 'estados'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $validated = $request->validate([
            'marca_id' => 'required|exists:marcas,id',
            'modelo' => [
                'required',
                'string',
                'max:255',
                Rule::unique('equipos')->ignore($equipo->id)->where(function ($query) use ($request) {
                    return $query->where('marca_id', $request->marca_id);
                }),
            ],
            'descripcion' => 'required|string|max:1000',
            'estado_id' => 'required|exists:estados,id',
            'fecha_adquisicion' => 'required|date',
        ]);

        $equipo->update($validated);

        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado exitosamente.');
    }

    public function destroy(Request $request, Equipo $equipo)
    {
        if ($equipo->prestamos()->exists()) {
            $message = 'No se puede eliminar el equipo porque tiene préstamos asociados.';

            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 409);
            }

            return redirect()->route('equipos.index')->with('error', $message);
        }

        $equipo->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Equipo eliminado exitosamente.']);
        }

        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado exitosamente.');
    }
}