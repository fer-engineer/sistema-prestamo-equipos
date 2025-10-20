@props(['name'])

@switch($name)
    @case('dashboard')
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <rect x="3" y="11" width="3" height="10" rx="1" />
            <rect x="9" y="7" width="3" height="14" rx="1" />
            <rect x="15" y="3" width="3" height="18" rx="1" />
        </svg>
        @break

    @case('estados')
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10l5 5v6a2 2 0 01-2 2H4a2 2 0 01-2-2V9a2 2 0 012-2h3z"></path>
            <circle cx="9" cy="9" r="1.5" fill="currentColor" />
        </svg>
        @break

    @case('marcas')
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7l5-5 9 9-5 5-9-9z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7l5 5" />
        </svg>
        @break

    @case('roles')
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7l3-7z" />
        </svg>
        @break

    @case('encargados')
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <circle cx="12" cy="8" r="3" stroke="currentColor" stroke-width="1.5" fill="none" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 20a8 8 0 0116 0" />
        </svg>
        @break

    @case('personas')
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" />
            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="1.5" fill="none" />
        </svg>
        @break

    @case('docentes')
    @case('estudiantes')
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14v7" />
        </svg>
        @break

    @case('equipos')
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <rect x="3" y="7" width="18" height="10" rx="2" stroke-width="1.5" />
            <circle cx="12" cy="12" r="2" stroke-width="1.5" />
        </svg>
        @break

    @case('prestamos')
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <rect x="8" y="2" width="8" height="4" rx="1" stroke-width="1.5" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h18v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
        </svg>
        @break

    @case('logout')
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8v8" />
        </svg>
        @break

    @default
        <svg {{ $attributes->merge(['class' => 'w-6 h-6 text-gray-600']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <circle cx="12" cy="12" r="10" stroke-width="1.5" />
        </svg>
@endswitch
