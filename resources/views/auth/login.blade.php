<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="flex items-center gap-2 mt-1">

                {{-- Input Password --}}
                <x-text-input
                    id="password"
                    class="block w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />

                {{-- Eye Button --}}
                <button
                    type="button"
                    onclick="togglePassword()"
                    class="flex items-center justify-center text-gray-500 hover:text-gray-700 focus:outline-none"
                    title="Lihat password"
                >
                    <svg id="eyeIcon"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.644
                            C3.423 7.51 7.36 4.5 12 4.5c4.638 0
                            8.573 3.007 9.963 7.178.07.21.07.434
                            0 .644C20.573 16.49 16.638 19.5 12
                            19.5c-4.638 0-8.573-3.007-9.963-7.178z" />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <script>
            function togglePassword() {
                const password = document.getElementById('password');
                const icon = document.getElementById('eyeIcon');

                if (password.type === 'password') {
                    password.type = 'text';

                    icon.innerHTML = `
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 002.036
                            12.322a1.012 1.012 0 000 .644C3.423
                            17.49 7.36 20.5 12 20.5c1.817 0
                            3.51-.491 4.973-1.348M6.228 6.228A10.45
                            10.45 0 0112 4.5c4.638 0 8.573
                            3.007 9.963 7.178a1.012 1.012 0
                            010 .644 10.523 10.523 0 01-4.132
                            5.099M6.228 6.228L3 3m3.228 3.228
                            l3.65 3.65m7.894 7.894L21 21m-3.228-3.228
                            l-3.65-3.65m0 0a3 3 0 11-4.243-4.243
                            m4.242 4.242L9.88 9.88" />
                    `;
                } else {
                    password.type = 'password';

                    icon.innerHTML = `
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.644
                            C3.423 7.51 7.36 4.5 12 4.5c4.638 0
                            8.573 3.007 9.963 7.178.07.21.07.434
                            0 .644C20.573 16.49 16.638 19.5 12
                            19.5c-4.638 0-8.573-3.007-9.963-7.178z" />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    `;
                }
            }
        </script>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
