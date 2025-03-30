<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header title="Forgot password" description="Enter your email to receive a password reset link" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-input id="username" class="block mt-1 w-full" type="email" name="username"
                    placeholder="email@example.com" :value="old('username')" required autofocus />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <x-button variant="primary" type="submit" class="w-full">{{ __('Email Password Reset Link') }}</x-button>

            <div class="space-x-1 text-center text-sm text-on-surface dark:text-on-surface-dark">
                Or return to
                <x-link href="{{ route('login') }}">{{ __('login') }}</x-link>
            </div>
        </form>
    </div>
</x-layouts.auth>
