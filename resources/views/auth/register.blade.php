<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header title="Create an account" description="Enter your details below to create your account" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="full_name" :value="__('Full Name')" />
                <x-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" placeholder="Full name"
                    :value="old('full_name')" required autofocus autocomplete="full_name" />
                <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-input id="username" class="block mt-1 w-full" type="email" name="username"
                    placeholder="email@example.com" :value="old('username')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-input variant="password" id="password" class="block mt-1 w-full" type="password" name="password"
                    placeholder="Password" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input variant="password" id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end">
                <x-button variant="primary" type="submit" class="w-full">{{ __('Create account') }}</x-button>
            </div>

            <div class="space-x-1 text-center text-sm text-on-surface dark:text-on-surface-dark">
                {{ __('Already have an account?') }}
                <x-link href="{{ route('login') }}">{{ __('Log in') }}</x-link>
            </div>
        </form>
    </div>
</x-layouts.auth>
