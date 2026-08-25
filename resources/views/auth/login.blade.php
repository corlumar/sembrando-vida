<x-guest-layout>

    <div
        class="w-full max-w-md rounded-lg bg-white p-8 shadow-lg"
        style="background-image: none;"
    >

        <div class="mb-6 text-center">
            <img
                src="{{ asset('img/logosv.png') }}"
                alt="Sembrando Vida"
                class="mx-auto h-20 w-auto"
            >

            <h1 class="mt-4 text-xl font-semibold text-gray-900">
                Sembrando Vida
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Acceso al sistema
            </p>
        </div>

        @if (session('status'))
            <div
                class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700"
            >
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div
                class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-700"
            >
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label
                    for="email"
                    :value="__('Email')"
                />

                <x-text-input
                    id="email"
                    class="mt-1 block w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                />
            </div>

            <div class="mt-4">
                <x-input-label
                    for="password"
                    :value="__('Password')"
                />

                <x-text-input
                    id="password"
                    class="mt-1 block w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
            </div>

            <div class="mt-4">
                <label
                    for="remember"
                    class="inline-flex items-center"
                >
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    >

                    <span class="ms-2 text-sm text-gray-600">
                        Recordarme
                    </span>
                </label>
            </div>

            <div class="mt-6 flex items-center justify-between">

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-sm text-gray-600 underline hover:text-gray-900"
                    >
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <x-primary-button>
                    Entrar
                </x-primary-button>

            </div>

        </form>

    </div>

</x-guest-layout>
