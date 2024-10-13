<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <h2 id="login-name">Slaptažodžio atkūrimas</h2>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Pamiršai slaptažodį? Tiesiog praneškite mums savo el. pašto adresą ir mes el. paštu atsiųsime jums slaptažodžio nustatymo iš naujo nuorodą, kuri leis jums pasirinkti naują.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Elektroninis paštas') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('El. pašto slaptažodžio nustatymo iš naujo nuoroda') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
