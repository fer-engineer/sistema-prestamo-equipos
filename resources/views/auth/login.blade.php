<x-guest-layout>
    <div class="text-center">
        <h1 class="text-2xl font-bold text-gray-800">Iniciar sesión</h1>
        <p class="text-sm text-gray-500 mt-1">Introduce tus credenciales para acceder al sistema</p>
    </div>

    <x-auth-session-status class="my-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-6">
        @csrf

        <div class="mb-4">
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">{{ __('¿Olvidaste tu contraseña?') }}</a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full justify-center">
                {{ __('Iniciar sesión') }}
            </x-primary-button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">¿No tienes cuenta? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Regístrate</a></p>
        </div>
    @endif
</x-guest-layout>
