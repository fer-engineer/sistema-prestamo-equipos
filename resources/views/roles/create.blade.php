@extends('layouts.app')

@section('title', 'Crear Rol')

@section('content')
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8 border-b border-gray-200">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Registrar Nuevo Rol</h1>
            <p class="text-sm text-gray-500">Complete el formulario para agregar un nuevo rol de usuario.</p>
        </div>
        <a href="{{ route('roles.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 border border-gray-300 hover:border-gray-400 rounded-lg px-4 py-2 transition-all duration-200 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver al listado
        </a>
    </div>

    <form action="{{ route('roles.store') }}" method="POST" class="space-y-6">
        @csrf
        <!-- Campo Nombre -->
        <div class="space-y-2">
            <label for="nombre" class="text-sm font-semibold text-gray-700">Nombre del Rol</label>
            <input type="text" id="nombre" name="nombre" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nombre') border-red-500 @enderror" placeholder="Ej: Administrador, Editor" value="{{ old('nombre') }}">
            @error('nombre')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Descripción -->
        <div class="space-y-2">
            <label for="descripcion" class="text-sm font-semibold text-gray-700">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('descripcion') border-red-500 @enderror" placeholder="Información adicional sobre el rol...">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones de Acción -->
        <div class="border-t border-gray-200 pt-6 flex justify-end space-x-4">
            <a href="{{ route('roles.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-all duration-200">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Guardar Rol
            </button>
        </div>
    </form>
</div>
@endsection
