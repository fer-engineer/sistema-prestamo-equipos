<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Préstamos</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            /* Reducir tamaño para más espacio */
        }

        th,
        td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
            white-space: normal;
            /* Permite saltos de línea */
            word-wrap: break-word;
            /*  Corta palabras largas */
        }

        th {
            background-color: #f2f2f2;
            text-transform: uppercase;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Reporte de Historial de Préstamos</h1>
        <p>
            Desde: {{ $fecha_inicio }}
            @if (!empty($fecha_fin))
                Hasta: {{ $fecha_fin }}
            @else
                Hasta: Actualidad
            @endif
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Equipo</th>
                <th>Persona</th>
                <th>Encargado</th>
                <th>Fecha Préstamo</th>
                <th>Fecha Devolución</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prestamos as $prestamo)
                <tr>
                    <td>{{ $prestamo->id }}</td>
                    <td>
                        {{ optional(optional($prestamo->equipo)->marca)->nombre }} -
                        {{ optional($prestamo->equipo)->modelo }}
                    </td>
                    <td>
                        {{ optional($prestamo->persona)->nombre }} {{ optional($prestamo->persona)->apellido }}
                    </td>
                    <td>
                        {{ optional(optional($prestamo->encargado)->user)->name ?? 'N/A' }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}
                    </td>
                    <td>
                        {{ $prestamo->fecha_devolucion ? \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y') : 'Pendiente' }}
                    </td>
                    <td>{{ optional($prestamo->estado)->nombre }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="no-data">
                        {{ $fecha_inicio === 'Historial Completo'
                            ? 'No hay registros de préstamos en el sistema.'
                            : 'No se encontraron préstamos en el rango de fechas seleccionado.' }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
