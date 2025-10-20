@extends('layouts.app')

@section('title', 'Detalles del Préstamo')

@section('content')
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8 border-b border-gray-200">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detalles del Préstamo</h1>
            <p class="text-sm text-gray-500">Información registrada del préstamo.</p>
        </div>
        <a href="{{ route('prestamos.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 border border-gray-300 hover:border-gray-400 rounded-lg px-4 py-2 transition-all duration-200 flex items-center">
            Volver al listado
        </a>
    </div>

    <div class="border-t border-gray-200">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">ID</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $prestamo->id }}</dd>
            </div>

            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Equipo</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $prestamo->equipo->modelo ?? 'N/A' }}</dd>
            </div>

            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Persona</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $prestamo->persona->nombre ?? 'N/A' }} {{ $prestamo->persona->apellido ?? '' }}</dd>
            </div>

            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Encargado</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $prestamo->encargado->nombre_completo ?? 'N/A' }}</dd>
            </div>

            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Fecha Préstamo</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $prestamo->fecha_prestamo?->format('d/m/Y') }}</dd>
            </div>

            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Fecha Devolución</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $prestamo->fecha_devolucion ? $prestamo->fecha_devolucion->format('d/m/Y') : 'Pendiente' }}</dd>
            </div>

            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Estado</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $prestamo->estado->nombre ?? 'N/A' }}</dd>
            </div>

            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Observaciones</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $prestamo->observaciones ?? '-' }}</dd>
            </div>
        </dl>
    </div>

    <div class="border-t border-gray-200 pt-6 flex justify-end space-x-4">
        <a href="{{ route('prestamos.edit', $prestamo) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
            Editar Préstamo
        </a>
    </div>
</div>
@endsection