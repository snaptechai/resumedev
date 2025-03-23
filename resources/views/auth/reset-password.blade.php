<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header title="Reset password" description="Please enter your new password below" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                    placeholder="email@example.com" :value="old('email')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
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
                <x-button variant="primary" type="submit" class="w-full">{{ __('Reset Password') }}</x-button>
            </div>

        </form>
    </div>
</x-layouts.auth>
