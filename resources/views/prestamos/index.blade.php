@extends('layouts.app')

@section('title', 'Préstamos')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-semibold text-gray-800">Préstamos</h2>
        <p class="text-sm text-gray-500">Listado de préstamos registrados.</p>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('reportes.pdf.all') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 text-white rounded-md shadow hover:bg-gray-700 focus:outline-none">
           <!-- Ícono de reportes (documento con gráfico) -->
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
  <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
  <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg>
            Generar Reporte
        </a>
        <a href="{{ route('prestamos.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nuevo Préstamo
        </a>
    </div>
</div>


<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Equipo</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Persona</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Encargado</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Fecha Préstamo</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Fecha Devolución</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @forelse($prestamos as $prestamo)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $prestamo->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $prestamo->equipo->modelo ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $prestamo->persona->nombre ?? 'N/A' }} {{ $prestamo->persona->apellido ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $prestamo->encargado->nombre_completo ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $prestamo->fecha_prestamo->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $prestamo->fecha_devolucion ? $prestamo->fecha_devolucion->format('d/m/Y') : 'Pendiente' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $prestamo->estado->nombre ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('prestamos.show', $prestamo) }}" class="inline-flex items-center px-3 py-1.5 mr-2 bg-blue-100 text-blue-800 border border-blue-200 rounded hover:bg-blue-200 text-sm">Ver</a>
                        @can('update', $prestamo)
                        <a href="{{ route('prestamos.edit', $prestamo) }}" class="inline-flex items-center px-3 py-1.5 mr-2 bg-green-100 text-green-800 border border-green-200 rounded hover:bg-green-200 text-sm">Modificar</a>
                        @endcan
                        @can('delete', $prestamo)
                       <form action="{{ route('prestamos.destroy', $prestamo) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-800 border border-red-200 rounded hover:bg-red-200 text-sm btn-eliminar">Eliminar</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                        No hay préstamos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $prestamos->links() }}
    </div>
</div>

@endsection
