<?php

namespace App\Http\Controllers;

use App\Models\Encargado;
use App\Models\Estado;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EncargadoController extends Controller
{
    public function index()
    {
        // Obtenemos solo los encargados cuyo usuario tiene el rol de "Encargado"
        $encargados = Encargado::whereHas('user.rol', function ($query) {
            $query->where('nombre', 'Encargado');
        })->with(['estado', 'user.rol'])->paginate(10);

        return view('encargados.index', compact('encargados'));
    }

    public function create()
    {
        $estados = Estado::where('tipo_estado', 'Usuario')->get();
        $roles = Rol::all();
        return view('encargados.create', compact('estados', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'estado_id' => 'required|exists:estados,id',
            'rol_id' => 'required|exists:roles,id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Usamos una transacción para asegurar la integridad de los datos
        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['nombre'] . ' ' . $validated['apellido'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id' => $validated['rol_id'],
            ]);

            Encargado::create([
                'nombre' => $validated['nombre'],
                'apellido' => $validated['apellido'],
                'correo' => $validated['email'], // Mantenemos el correo aquí si es necesario
                'telefono' => $validated['telefono'],
                'estado_id' => $validated['estado_id'],
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('encargados.index')
            ->with('success', 'Encargado creado exitosamente.');
    }

    public function show(Encargado $encargado)
    {
        $encargado->load('user.rol', 'estado');
        return view('encargados.show', compact('encargado'));
    }

    public function edit(Encargado $encargado)
    {
        $encargado->load('user');
        $estados = Estado::where('tipo_estado', 'Usuario')->get();
        $roles = Rol::all();
        return view('encargados.edit', compact('encargado', 'estados', 'roles'));
    }

    public function update(Request $request, Encargado $encargado)
    {
        $user = $encargado->user;

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'estado_id' => 'required|exists:estados,id',
            'rol_id' => 'required|exists:roles,id',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($user, $encargado, $validated) {
            $user->update([
                'name' => $validated['nombre'] . ' ' . $validated['apellido'],
                'email' => $validated['email'],
                'role_id' => $validated['rol_id'],
            ]);

            if (!empty($validated['password'])) {
                $user->update(['password' => Hash::make($validated['password'])]);
            }

            $encargado->update([
                'nombre' => $validated['nombre'],
                'apellido' => $validated['apellido'],
                'correo' => $validated['email'],
                'telefono' => $validated['telefono'],
                'estado_id' => $validated['estado_id'],
            ]);
        });

        return redirect()->route('encargados.index')
            ->with('success', 'Encargado actualizado exitosamente.');
    }

    public function destroy(Request $request, Encargado $encargado)
    {
        if ($encargado->prestamos()->exists()) {
            $message = 'No se puede eliminar el encargado porque tiene préstamos asociados.';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 409);
            }
            return redirect()->route('encargados.index')->with('error', $message);
        }

        DB::transaction(function () use ($encargado) {
            $user = $encargado->user;
            $encargado->delete();
            if ($user) {
                $user->delete();
            }
        });

        $message = 'Encargado y usuario asociado eliminados exitosamente.';
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->route('encargados.index')->with('success', $message);
    }
}