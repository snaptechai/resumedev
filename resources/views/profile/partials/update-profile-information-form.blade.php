<section>
    <!-- Header -->
    <header>
        <x-typography.heading class="mb-2" accent>
            {{ __('Profile') }}
        </x-typography.heading>
        <x-typography.subheading>
            {{ __('Update your name and email address') }}
        </x-typography.subheading>
    </header>

    <!-- Email Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Profile Update Form -->
    <form method="post" action="{{ route('settings.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email Field -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <!-- Email Verification Notice -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-on-surface dark:text-on-surface-dark">
                        {{ __('Your email address is unverified.') }}

                        <button
                            class="font-medium text-primary underline-offset-2 hover:underline focus:underline focus:outline-hidden dark:text-primary-dark"
                            form="send-verification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Form Actions -->
        <div class="flex items-center gap-4">
            <x-button variant="primary">
                {{ __('Save') }}
            </x-button>

            <!-- Success Message -->
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-on-surface dark:text-on-surface-dark">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
