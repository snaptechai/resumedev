<section class="space-y-6">
    <header>
        <x-typography.heading class="mb-2" accent>{{ __('Delete account') }}</x-typography.heading>
        <x-typography.subheading>{{ __('Delete your account and all of its resources') }}</x-typography.subheading>
    </header>
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" :maxWidth="'lg'">
        <x-slot name="trigger">
            <x-button variant="danger" x-on:click="modalIsOpen = true">{{ __('Delete Account') }}</x-button>
        </x-slot>
        <x-slot name="header">
            <x-typography.subheading accent
                size="lg">{{ __('Are you sure you want to delete your account?') }}</x-typography.subheading>
        </x-slot>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="p-4">
                <p class="text-sm text-on-surface dark:text-on-surface-dark">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-input variant="password" id="password" placeholder="{{ __('Password') }}" class="block w-3/4"
                        type="password" name="password" required autocomplete="current-password" />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

            </div>

            <div
                class="mt-4 flex flex-col-reverse justify-between gap-2 border-t border-outline bg-surface-alt/60 p-4 dark:border-outline-dark dark:bg-surface-dark/20 sm:flex-row sm:items-center md:justify-end">
                <x-button variant="ghost" type="button" x-on:click="modalIsOpen = false">
                    {{ __('Cancel') }}
                </x-button>

                <x-button variant="danger" type="submit" class="ms-3">
                    {{ __('Delete Account') }}
                </x-button>
            </div>

        </form>
    </x-modal>
</section>
