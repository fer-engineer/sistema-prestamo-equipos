@extends('layouts.app')

@section('title', 'Editar Persona')

@section('content')
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8 border-b border-gray-200">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Editar Persona</h1>
            <p class="text-sm text-gray-500">Actualice el formulario para modificar los datos de la persona.</p>
        </div>
        <a href="{{ route('personas.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 border border-gray-300 hover:border-gray-400 rounded-lg px-4 py-2 transition-all duration-200 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver al listado
        </a>
    </div>

    <form action="{{ route('personas.update', $persona) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Campo Nombre -->
            <div class="space-y-2">
                <label for="nombre" class="text-sm font-semibold text-gray-700">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nombre') border-red-500 @enderror" value="{{ old('nombre', $persona->nombre) }}">
                @error('nombre')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Apellido -->
            <div class="space-y-2">
                <label for="apellido" class="text-sm font-semibold text-gray-700">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('apellido') border-red-500 @enderror" value="{{ old('apellido', $persona->apellido) }}">
                @error('apellido')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Correo -->
            <div class="space-y-2">
                <label for="correo" class="text-sm font-semibold text-gray-700">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('correo') border-red-500 @enderror" value="{{ old('correo', $persona->correo) }}">
                @error('correo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Teléfono -->
            <div class="space-y-2">
                <label for="telefono" class="text-sm font-semibold text-gray-700">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('telefono') border-red-500 @enderror" value="{{ old('telefono', $persona->telefono) }}">
                @error('telefono')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Tipo de Usuario -->
            <div class="space-y-2">
                <label for="tipo_usuario_id" class="text-sm font-semibold text-gray-700">Tipo de Usuario</label>
                <select id="tipo_usuario_id" name="tipo_usuario_id" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tipo_usuario_id') border-red-500 @enderror">
                    <option value="">Seleccione un tipo</option>
                    @foreach($tiposUsuario as $tipoUsuario)
                        <option value="{{ $tipoUsuario->id }}" {{ old('tipo_usuario_id', $persona->tipo_usuario_id) == $tipoUsuario->id ? 'selected' : '' }}>{{ $tipoUsuario->nombre }}</option>
                    @endforeach
                </select>
                @error('tipo_usuario_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Estado -->
            <div class="space-y-2">
                <label for="estado_id" class="text-sm font-semibold text-gray-700">Estado</label>
                <select id="estado_id" name="estado_id" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('estado_id') border-red-500 @enderror">
                    <option value="">Seleccione un estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}" {{ old('estado_id', $persona->estado_id) == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
                    @endforeach
                </select>
                @error('estado_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="border-t border-gray-200 pt-6 flex justify-end space-x-4">
            <a href="{{ route('personas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-all duration-200">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Actualizar Persona
            </button>
        </div>
    </form>
</div>
@endsection