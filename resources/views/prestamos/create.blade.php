@extends('layouts.app')

@section('title', 'Crear Préstamo')

@section('content')
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8 border-b border-gray-200">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Registrar Nuevo Préstamo</h1>
            <p class="text-sm text-gray-500">Complete el formulario para agregar un nuevo préstamo.</p>
        </div>
        <a href="{{ route('prestamos.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 border border-gray-300 hover:border-gray-400 rounded-lg px-4 py-2 transition-all duration-200 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver al listado
        </a>
    </div>

    <form action="{{ route('prestamos.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Equipo -->
            <div class="space-y-2">
                <label for="equipo_id" class="text-sm font-semibold text-gray-700">Equipo</label>
                <select id="equipo_id" name="equipo_id" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('equipo_id') border-red-500 @enderror">
                    <option value="">Seleccione un equipo</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}" {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                            {{ $equipo->modelo }}
                        </option>
                    @endforeach
                </select>
                @error('equipo_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Persona -->
            <div class="space-y-2">
                <label for="persona_id" class="text-sm font-semibold text-gray-700">Persona</label>
                <select id="persona_id" name="persona_id" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('persona_id') border-red-500 @enderror">
                    <option value="">Seleccione una persona</option>
                    @foreach($personas as $persona)
                        <option value="{{ $persona->id }}" {{ old('persona_id') == $persona->id ? 'selected' : '' }}>
                            {{ $persona->nombre }} {{ $persona->apellido }}
                        </option>
                    @endforeach
                </select>
                @error('persona_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Encargado -->
            <div class="space-y-2">
                <label for="encargado_id" class="text-sm font-semibold text-gray-700">Encargado</label>
                <select id="encargado_id" name="encargado_id" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('encargado_id') border-red-500 @enderror">
                    <option value="">Seleccione un encargado</option>
                    @foreach($encargados as $encargado)
                        <option value="{{ $encargado->id }}" {{ old('encargado_id') == $encargado->id ? 'selected' : '' }}>
                            {{ $encargado->nombre_completo }}
                        </option>
                    @endforeach
                </select>
                @error('encargado_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Estado -->
            <div class="space-y-2">
                <label for="estado_id" class="text-sm font-semibold text-gray-700">Estado</label>
                <select id="estado_id" name="estado_id" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('estado_id') border-red-500 @enderror">
                    <option value="">Seleccione un estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}" {{ old('estado_id') == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
                    @endforeach
                </select>
                @error('estado_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha de Préstamo -->
            <div class="space-y-2">
                <label for="fecha_prestamo" class="text-sm font-semibold text-gray-700">Fecha de Préstamo</label>
                <input type="date" id="fecha_prestamo" name="fecha_prestamo" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('fecha_prestamo') border-red-500 @enderror" value="{{ old('fecha_prestamo', date('Y-m-d')) }}">
                @error('fecha_prestamo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha de Devolución -->
            <div class="space-y-2">
                <label for="fecha_devolucion" class="text-sm font-semibold text-gray-700">Fecha de Devolución (opcional)</label>
                <input type="date" id="fecha_devolucion" name="fecha_devolucion" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('fecha_devolucion') border-red-500 @enderror" value="{{ old('fecha_devolucion') }}">
                @error('fecha_devolucion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Observaciones -->
            <div class="md:col-span-2 space-y-2">
                <label for="observaciones" class="text-sm font-semibold text-gray-700">Observaciones</label>
                <textarea id="observaciones" name="observaciones" rows="4" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('observaciones') border-red-500 @enderror" placeholder="Agregar notas si es necesario...">{{ old('observaciones') }}</textarea>
                @error('observaciones')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Botones -->
        <div class="border-t border-gray-200 pt-6 flex justify-end space-x-4">
            <a href="{{ route('prestamos.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-all duration-200">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Guardar Préstamo
            </button>
        </div>
    </form>
</div>
@endsection