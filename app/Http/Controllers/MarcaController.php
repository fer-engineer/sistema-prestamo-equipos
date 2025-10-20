<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::paginate(10);
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:marcas|max:255',
            'descripcion' => 'required|string',
        ]);

        Marca::create($validated);

        return redirect()->route('marcas.index')
            ->with('success', 'Marca creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        return view('marcas.show', compact('marca'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('marcas')->ignore($marca->id),
            ],
            'descripcion' => 'required|string',
        ]);

        $marca->update($validated);

        return redirect()->route('marcas.index')
            ->with('success', 'Marca actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Marca $marca)
    {
        if ($marca->equipos()->exists()) {
            $message = 'No se puede eliminar la marca porque está asignada a uno o más equipos.';

            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 409);
            }

            return redirect()->route('marcas.index')->with('error', $message);
        }

        $marca->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Marca eliminada exitosamente.']);
        }

        return redirect()->route('marcas.index')
            ->with('success', 'Marca eliminada correctamente.');
    }
}
