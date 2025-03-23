<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header title="Confirm password"
            description="This is a secure area of the application. Please confirm your password before continuing." />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.confirm') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-input variant="password" id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <x-button variant="primary">
                {{ __('Confirm') }}
            </x-button>
        </form>
    </div>
</x-layouts.auth>
