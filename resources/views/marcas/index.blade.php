@extends('layouts.app')

@section('title', 'Marcas')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-semibold text-gray-800">Marcas</h2>
        <p class="text-sm text-gray-500">Listado de marcas registradas.</p>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('marcas.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nueva Marca
        </a>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @forelse($marcas as $marca)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $marca->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $marca->nombre }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xl truncate">{{ $marca->descripcion }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('marcas.show', $marca) }}" class="inline-flex items-center px-3 py-1.5 mr-2 bg-blue-100 text-blue-800 border border-blue-200 rounded hover:bg-blue-200 text-sm">Ver</a>
                        <a href="{{ route('marcas.edit', $marca) }}" class="inline-flex items-center px-3 py-1.5 mr-2 bg-green-100 text-green-800 border border-green-200 rounded hover:bg-green-200 text-sm">Modificar</a>
                        <form action="{{ route('marcas.destroy', $marca) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-800 border border-red-200 rounded hover:bg-red-200 text-sm btn-eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        No hay marcas registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $marcas->links() }}
    </div>
</div>

@endsection
