<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::paginate(10); // Cambiado a paginate para mejor rendimiento
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:roles|max:255',
            'descripcion' => 'required|string',
        ]);

        Rol::create($validated);

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function show(Rol $rol)
    {
        return view('roles.show', compact('rol'));
    }

    public function edit(Rol $rol)
    {
        return view('roles.edit', compact('rol'));
    }

    public function update(Request $request, Rol $rol)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('roles')->ignore($rol->id),
            ],
            'descripcion' => 'required|string',
        ]);

        $rol->update($validated);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy(Rol $rol)
    {
        if ($rol->encargados()->exists()) {
            return redirect()->route('roles.index')
                ->with('error', 'No se puede eliminar el rol porque está asignado a uno o más encargados.');
        }

        $rol->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado correctamente.');
    }
}
