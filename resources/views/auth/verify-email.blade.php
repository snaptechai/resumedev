<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <div class="text-center text-sm text-on-surface dark:text-on-surface-dark">
            {{ __('Please verify your email address by clicking on the link we just emailed to you.') }}
        </div>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="font-medium text-center text-sm text-success">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="flex flex-col items-center justify-between space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-button variant="primary" type="submit">
                    {{ __('Resend Verification Email') }}
                </x-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm text-on-surface dark:text-on-surface-dark hover:underline">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-layouts.auth>
