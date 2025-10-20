<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte de Historial de Préstamos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Formulario de Filtro -->
                    <form action="{{ route('reportes.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div>
                                <x-input-label for="fecha_inicio" :value="__('Fecha de Inicio')" />
                                <x-text-input id="fecha_inicio" class="block mt-1 w-full" type="date"
                                    name="fecha_inicio" :value="old('fecha_inicio', $fecha_inicio ?? '')" required autofocus />
                                <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="fecha_fin" :value="__('Fecha de Fin')" />
                                <x-text-input id="fecha_fin" class="block mt-1 w-full" type="date" name="fecha_fin"
                                    :value="old('fecha_fin', $fecha_fin ?? '')" required />
                                <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
                            </div>
                            <div class="flex items-end">
                                <x-primary-button>
                                    {{ __('Generar Reporte') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>

                    <!-- Resultados del Reporte -->
                    @if (isset($prestamos))
                        <div class="mt-8">
                            @if ($prestamos->isEmpty())
                                <p class="text-center text-gray-500">No se encontraron préstamos en el rango de fechas
                                    seleccionado.</p>
                            @else
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold">Resultados del Reporte ({{ $fecha_inicio }} al
                                        {{ $fecha_fin }})</h3>
                                    <a href="{{ route('reportes.pdf', ['fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin]) }}"
                                        target="_blank">
                                        <x-secondary-button>
                                            {{ __('Descargar PDF') }}
                                        </x-secondary-button>
                                    </a>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    ID</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Equipo</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Persona</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Encargado</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Fecha Préstamo</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Fecha Devolución</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach ($prestamos as $prestamo)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $prestamo->id }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $prestamo->equipo->marca->nombre }}
                                                        {{ $prestamo->equipo->modelo }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $prestamo->persona->nombre }}
                                                        {{ $prestamo->persona->apellido }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $prestamo->encargado->nombre }}
                                                        {{ $prestamo->encargado->apellido }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $prestamo->fecha_devolucion ? \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y') : 'Pendiente' }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $prestamo->estado->nombre }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
