<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Encargado;
use App\Models\Persona;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = Prestamo::with(['equipo', 'encargado', 'persona', 'estado'])->paginate(10);
        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        $equipos = Equipo::whereHas('estado', function ($query) {
            $query->where('nombre', 'Disponible');
        })->get();
        $encargados = Encargado::latest()->take(100)->get();
        $personas = Persona::latest()->take(100)->get();
        $estados = Estado::where('tipo_estado', 'Prestamo')->get();

        return view('prestamos.create', compact('equipos', 'encargados', 'personas', 'estados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipo_id'    => 'required|exists:equipos,id',
            'encargado_id' => 'required|exists:encargados,id',
            'persona_id' => 'required|exists:personas,id',
            'estado_id'    => 'required|exists:estados,id',
            'fecha_prestamo'   => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'observaciones'    => 'nullable|string|max:500',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // 1. Create the loan
                $prestamo = Prestamo::create($validated);

                // 2. Find the ID for the 'En préstamo' status for equipment
                $estadoEnPrestamo = Estado::where('tipo_estado', 'Equipo')->where('nombre', 'En préstamo')->firstOrFail();

                // 3. Update the equipment's status
                $equipo = Equipo::findOrFail($validated['equipo_id']);
                $equipo->estado_id = $estadoEnPrestamo->id;
                $equipo->save();
            });

            return redirect()->route('prestamos.index')->with('success', 'Préstamo creado exitosamente y estado del equipo actualizado.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el préstamo: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Prestamo $prestamo)
    {
        $prestamo->load(['equipo', 'encargado', 'persona', 'estado']);
        return view('prestamos.show', compact('prestamo'));
    }

    public function edit(Prestamo $prestamo)
    {
        $equipos = Equipo::whereHas('estado', function ($query) {
            $query->where('nombre', 'Disponible');
        })->orWhere('id', $prestamo->equipo_id)->get();
        
        $encargados = Encargado::latest()->take(100)->get();
        $personas = Persona::latest()->take(100)->get();
        $estados = Estado::where('tipo_estado', 'Prestamo')->get();

        return view('prestamos.edit', compact('prestamo', 'equipos', 'encargados', 'personas', 'estados'));
    }

    public function update(Request $request, Prestamo $prestamo)
    {
        $validated = $request->validate([
            'equipo_id'    => 'required|exists:equipos,id',
            'encargado_id' => 'required|exists:encargados,id',
            'persona_id' => 'required|exists:personas,id',
            'estado_id'    => 'required|exists:estados,id',
            'fecha_prestamo'   => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'observaciones'    => 'nullable|string|max:500',
        ]);

        try {
            DB::transaction(function () use ($prestamo, $validated) {
                $originalEquipoId = $prestamo->equipo_id;
                $newEquipoId = $validated['equipo_id'];

                // 1. Update the loan record
                $prestamo->update($validated);

                // Get necessary status IDs
                $estadoDevueltoId = Estado::where('tipo_estado', 'Prestamo')->where('nombre', 'Devuelto')->value('id');
                $estadoDisponibleId = Estado::where('tipo_estado', 'Equipo')->where('nombre', 'Disponible')->value('id');
                $estadoEnPrestamoId = Estado::where('tipo_estado', 'Equipo')->where('nombre', 'En préstamo')->value('id');

                // If the equipment was changed, make the old one available
                if ($originalEquipoId != $newEquipoId) {
                    $oldEquipo = Equipo::find($originalEquipoId);
                    if ($oldEquipo) {
                        $oldEquipo->estado_id = $estadoDisponibleId;
                        $oldEquipo->save();
                    }
                }

                // Now, set the status of the CURRENT equipment based on the loan's status
                $currentEquipo = Equipo::find($newEquipoId);
                if ($currentEquipo) {
                    if ($prestamo->estado_id == $estadoDevueltoId) {
                        // If the loan is 'Devuelto', the equipment is 'Disponible'
                        $currentEquipo->estado_id = $estadoDisponibleId;
                    } else {
                        // For any other loan status ('Activo', etc.), the equipment is 'En préstamo'
                        $currentEquipo->estado_id = $estadoEnPrestamoId;
                    }
                    $currentEquipo->save();
                }
            });

            return redirect()->route('prestamos.index')->with('success', 'Préstamo actualizado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el préstamo: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request, Prestamo $prestamo)
    {
        try {
            DB::transaction(function () use ($prestamo) {
                $equipo = $prestamo->equipo;

                // 1. Make the equipment available again
                if ($equipo) {
                    $estadoDisponibleId = Estado::where('tipo_estado', 'Equipo')->where('nombre', 'Disponible')->value('id');
                    if ($estadoDisponibleId) {
                        $equipo->estado_id = $estadoDisponibleId;
                        $equipo->save();
                    }
                }

                // 2. Delete the loan
                $prestamo->delete();
            });

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Préstamo eliminado exitosamente.']);
            }
    
            return redirect()->route('prestamos.index')->with('success', 'Préstamo eliminado exitosamente y equipo marcado como disponible.');

        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Error al eliminar el préstamo: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Error al eliminar el préstamo: ' . $e->getMessage());
        }
    }
}
