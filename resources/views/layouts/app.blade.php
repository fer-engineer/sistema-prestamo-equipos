<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alertas.js') }}" defer></script>

</head>
<body class="bg-gray-100 flex min-h-screen font-sans">

<!-- Menú lateral -->
<aside class="w-80 bg-white shadow-lg fixed inset-y-0 left-0 flex flex-col h-screen">
    @auth
    <div class="p-6 flex-shrink-0 text-center">
        <!-- Título de la app -->
        <h2 class="text-3xl font-bold text-blue-600 mb-4">Préstamo Equipos</h2>

        <!-- Nombre y rol del usuario logueado -->
        <div class="bg-blue-50 rounded-lg shadow-sm py-2 px-3 mb-4 text-center">
            <p class="text-gray-800 font-semibold text-lg">{{ Auth::user()->name }}</p>
            <p class="text-sm text-gray-500 mt-1">
                {{ Auth::user()->rol_nombre === 'Administrador' ? 'Admin' : (Auth::user()->rol_nombre === 'Encargado' ? 'Encargado' : Auth::user()->rol_nombre) }}
            </p>
        </div>
    </div>

    <!-- Menú con scroll -->
    <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 transition">
            <span class="text-xl mr-3">📊</span>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Catálogos base -->
        @can('manage-system')
        <h3 class="text-xs uppercase text-gray-500 px-4 mt-4">Catálogos Base</h3>
        <a href="{{ route('estados.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 transition">
            <span class="text-xl mr-3">📌</span>
            <span class="font-medium">Estados</span>
        </a>
        <a href="{{ route('marcas.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 transition">
            <span class="text-xl mr-3">🏷️</span>
            <span class="font-medium">Marcas</span>
        </a>
        <a href="{{ route('tipos_usuario.index')}}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 transition">
            <span class="text-xl mr-3">🛡️</span>
            <span class="font-medium">Roles / Tipos</span>
        </a>
        @endcan

        <!-- Personas -->
        @can('manage-system')
        <h3 class="text-xs uppercase text-gray-500 px-4 mt-6">Personas</h3>
        <a href="{{ route('encargados.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 transition">
            <span class="text-xl mr-3">🧑‍💼</span>
            <span class="font-medium">Encargados</span>
        </a>
        <a href="{{ route('personas.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 transition">
            <span class="text-xl mr-3">👥</span>
            <span class="font-medium">Personas</span>
        </a>
        <a href="{{ route('detalles-docente.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 transition">
            <span class="text-xl mr-3">👨‍🏫</span>
            <span class="font-medium">Docentes</span>
        </a>
        <a href="{{ route('detalles-estudiante.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 transition">
            <span class="text-xl mr-3">🧑‍🎓</span>
            <span class="font-medium">Estudiantes</span>
        </a>
        @endcan

        <!-- Equipos -->
        <h3 class="text-xs uppercase text-gray-500 px-4 mt-6">Equipos</h3>
        <a href="{{ route('equipos.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 transition">
            <span class="text-xl mr-3">🎥</span>
            <span class="font-medium">Equipos</span>
        </a>

        <!-- Préstamos -->
        <h3 class="text-xs uppercase text-gray-500 px-4 mt-6">Préstamos</h3>
        <a href="{{ route('prestamos.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 transition">
            <span class="text-xl mr-3">📄</span>
            <span class="font-medium">Préstamos</span>
        </a>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t flex-shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-600 hover:bg-red-100 rounded-lg transition shadow-sm">
                <span class="text-xl mr-3">🚪</span>
                <span class="font-medium">Cerrar sesión</span>
            </button>
        </form>
    </div>

    @endauth
</aside>

<!-- Contenido principal -->
<main class="ml-80 flex-1 p-8">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @yield('content')
</main>

</body>
</html>
