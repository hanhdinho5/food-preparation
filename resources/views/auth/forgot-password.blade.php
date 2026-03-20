<x-guest-layout>
    <x-form-title :title="__('auth.titles.forgot_password')" :description="__('auth.descriptions.forgot_password')"></x-form-title>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('auth.descriptions.forgot_password_help') }}
    </div>

    @if (config('mail.default') === 'log')
        <div class="mb-4 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
            {{ __('auth.descriptions.forgot_password_log_mailer') }}
        </div>
    @endif

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('auth.labels.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full justify-center">
                {{ __('auth.actions.send_reset_link') }}
            </x-primary-button>
        </div>

        <div class="mt-4 text-center">
            <p class="text-gray-600">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('auth.actions.back_to_login') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
